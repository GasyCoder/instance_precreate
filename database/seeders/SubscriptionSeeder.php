<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Plan;
use App\Models\SubPlan;
use Carbon\Carbon;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        // Récupérer tous les utilisateurs ayant le rôle 'client' et tous les plans existants
        $users = User::role('client')->get();
        $plans = Plan::with('subPlans')->get(); // Charger les sous-plans avec les plans

        // Vérifier qu'il y a des utilisateurs et des plans disponibles
        if ($users->isEmpty()) {
            $this->command->warn('Aucun utilisateur avec le rôle "client" trouvé.');
            return;
        }

        if ($plans->isEmpty()) {
            $this->command->warn('Aucun plan trouvé.');
            return;
        }

        // Pour chaque utilisateur client
        foreach ($users as $user) {
            $numberOfSubscriptions = rand(1, 3);

            for ($i = 0; $i < $numberOfSubscriptions; $i++) {
                // Choisir un plan aléatoire
                $plan = $plans->random();

                // Choisir un sous-plan si le plan en a
                $subPlan = null;
                if ($plan->has_sub_plans && $plan->subPlans->isNotEmpty()) {
                    $subPlan = $plan->subPlans->random();
                }

                // Définir les dates
                $start_date = Carbon::now()->subMonths(rand(0, 2));
                $end_date = (clone $start_date)->addDays(14); // Période d'essai de 14 jours

                // Déterminer le statut (privilégier le statut 'trial' pour les nouvelles souscriptions)
                $isNewSubscription = $start_date->diffInDays(Carbon::now()) < 14;
                if ($isNewSubscription) {
                    $status = Subscription::STATUS_TRIAL;
                } else {
                    $statusOptions = [
                        Subscription::STATUS_ACTIVE,
                        Subscription::STATUS_EXPIRED,
                        Subscription::STATUS_CANCELLED
                    ];
                    $status = $statusOptions[array_rand($statusOptions)];
                }

                // Si le statut est 'active', ajuster la date de fin
                if ($status === Subscription::STATUS_ACTIVE) {
                    $end_date = Carbon::now()->addMonths(rand(1, 12));
                }

                // Créer l'abonnement
                Subscription::create([
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'sub_plan_id' => $subPlan ? $subPlan->id : null,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'status' => $status,
                ]);

                // Log pour le débogage
                $this->command->info(sprintf(
                    'Créé abonnement pour user %s: Plan %s%s - Status %s',
                    $user->email,
                    $plan->name,
                    $subPlan ? ' - ' . $subPlan->name : '',
                    $status
                ));
            }
        }

        // Créer au moins une souscription d'essai avec un sous-plan
        $trialUser = $users->random();
        $soloPlan = Plan::where('name', 'Solo')->first();

        if ($soloPlan && $soloPlan->subPlans->isNotEmpty()) {
            $basicSubPlan = $soloPlan->subPlans->where('name', 'Basic')->first();

            Subscription::create([
                'user_id' => $trialUser->id,
                'plan_id' => $soloPlan->id,
                'sub_plan_id' => $basicSubPlan->id,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(14),
                'status' => Subscription::STATUS_TRIAL,
            ]);

            $this->command->info(sprintf(
                'Créé abonnement d\'essai pour user %s: %s - %s',
                $trialUser->email,
                $soloPlan->name,
                $basicSubPlan->name
            ));
        }

        $this->command->info('Les abonnements ont été créés avec succès.');
    }
}
