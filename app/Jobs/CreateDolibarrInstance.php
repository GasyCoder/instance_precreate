<?php

namespace App\Jobs;

use App\Events\InstanceCreated;
use App\Models\DolibarrCredential;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\InstanceProvisioningService;
use App\Services\CreateUsersInnov;
use App\Notifications\InstanceCreated as InstanceCreatedNotification;
use Illuminate\Support\Facades\Hash;

class CreateDolibarrInstance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $instanceData;
    protected $user;
    protected $instance;

    public function __construct($instanceData, $user, $instance)
    {
        $this->instanceData = $instanceData;
        $this->user = $user;
        $this->instance = $instance;
    }

    public function handle()
    {
        try {
            $provisioningService = new InstanceProvisioningService();

            $instanceDetails = $provisioningService->provisionInstance(
                $this->instanceData['name'],
                $this->instanceData['password_dolibarr'],
                $this->instanceData['login_dolibarr'],
                $this->instanceData['url_suffix'],
                $this->instanceData['api_key_dolibarr'],
                $this->user->email
            );

            if ($instanceDetails) {
                // Créer les credentials Dolibarr
                DolibarrCredential::create([
                    'user_id' => $this->user->id,
                    'username' => $this->instanceData['login_dolibarr'],
                    'password' => Hash::make($this->instanceData['password_dolibarr']),
                ]);

                // Mettre à jour le statut de l'instance
                $this->instance->update([
                    'status' => 'active',
                    'url' => $instanceDetails['url']
                ]);

                // Créer l'utilisateur dans la base Innov
                $newUsersInnov = new CreateUsersInnov();
                $newUsersInnov->insertIntoOtherDb(
                    $this->instanceData['name'],
                    $this->user->email,
                    $this->instanceData['api_key_dolibarr'],
                    $this->instanceData['password_dolibarr'],
                    "http://" . $instanceDetails['url']
                );

                // Broadcaster l'événement
                broadcast(new InstanceCreated($this->instance));

                // Envoyer la notification
                $this->user->notify(new InstanceCreatedNotification([
                    'name' => $this->instanceData['name'],
                    'login' => $this->user->email,
                    'password' => $this->instanceData['password_dolibarr'],
                    'url' => "http://" . $this->instanceData['name'] . ".erpinnov.com",
                ]));
            }
        } catch (\Exception $e) {
            \Log::error('Erreur dans le job CreateDolibarrInstance: ' . $e->getMessage());
            $this->instance->update(['status' => 'failed']);
            throw $e;
        }
    }
}
