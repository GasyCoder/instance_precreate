<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Modules spécifiques pour le client
        $modules = [
            'profile' => [  // Pour gérer son profil
                'fr' => 'Profil',
                'description' => 'Gestion du profil client'
            ],
            'subscription' => [  // Pour voir ses abonnements
                'fr' => 'Abonnement',
                'description' => 'Gestion des abonnements'
            ],
            'instance' => [  // Pour voir ses instances
                'fr' => 'Instance',
                'description' => 'Gestion des instances'
            ],
        ];

        $actions = [
            'view' => 'Voir',
            'update' => 'Modifier',
        ];

        foreach ($modules as $moduleKey => $moduleInfo) {
            foreach ($actions as $actionKey => $actionLabel) {
                $name = "{$actionKey}_{$moduleKey}";  // Exemple: view_profile, update_profile

                $permission = Permission::create([
                    'name' => $name,
                    'label' => $actionLabel,
                    'description' => "{$actionLabel} - {$moduleInfo['description']}",
                    'module' => $moduleInfo['fr'],
                    'guard_name' => 'web',
                ]);

                // Log pour debug
                echo "Created permission: {$name}\n";
            }
        }
    }
}