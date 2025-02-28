<?php
namespace App\Services;

use App\Models\DolibarrCredential;
use App\Events\InstanceCreatedEvent;
use Illuminate\Support\Facades\Hash;
use App\Notifications\InstanceCreated;
use App\Notifications\SendInstanceCreatedEmail;

class FastInstanceProvisioningService {
    public function createInstance($instanceData, $user, $instance) {
        try {
            // Provisionnement synchrone
            $provisioningService = new InstanceProvisioningService();
            $instanceDetails = $provisioningService->provisionInstance(
                $instanceData['name'],
                $instanceData['password_dolibarr'],
                $instanceData['login_dolibarr'],
                $instanceData['url_suffix'],
                $instanceData['api_key_dolibarr'],
                $user->email,
                $instance['subscription_id']
            );

            if ($instanceDetails) {
                // Création des credentials
                DolibarrCredential::create([
                    'user_id' => $user->id,
                    'username' => $instanceData['login_dolibarr'],
                    'password' => Hash::make($instanceData['password_dolibarr']),
                ]);

                // Mise à jour instance
                $instance->update([
                    'status' => 'active',
                    'url' => $instanceDetails['url']
                ]);

                // Création utilisateur Innov
                $newUsersInnov = new CreateUsersInnov();
                $newUsersInnov->insertIntoOtherDb(
                    $instanceDetails['db_name'],
                    $instanceData['name'],
                    $user->email,
                    $instanceData['api_key_dolibarr'],
                    $instanceData['password_dolibarr'],
                    "http://" . $instanceData['name'] . '-dolibarr.erpinnov.com',
                    $instance['subscription_id']
                );

                // Notifications
                broadcast(new InstanceCreatedEvent($instance));
                SendInstanceCreatedEmail::dispatch($user, [
                    'name' => $instanceData['name'],
                    'login' => $user->email,
                    'password' => $instanceData['password_dolibarr'],
                    'url' => "http://" . $instanceData['name'] . ".erpinnov.com",
                ]);

                return true;
            }
            return false;
        } catch (\Exception $e) {
            \Log::error('Erreur création instance: ' . $e->getMessage());
            $instance->update(['status' => 'failed']);
            throw $e;
        }
    }
}
