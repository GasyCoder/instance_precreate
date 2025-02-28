<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'uuid' => Str::uuid(),
                'name' => 'Solo',
                'description' => 'Idéal pour les indépendants et micro-entrepreneurs.',
                'is_free' => false,
                'is_default' => false,
                'instance_limit' => 1,
                'duration_days' => null,
                'has_sub_plans' => true,
                'features' => json_encode([
                    '2 Go de stockage',
                    '1000 appels API'
                ]),
                'sub_plans' => [
                    [
                        'name' => 'Basic',
                        'price_monthly' => 5.00,
                        'price_yearly' => 60.00,
                        'price_local' => 25000.00,
                        'features' => ['Gestion des tiers', 'Produits', 'Stocks', 'Devis', 'Facturation', 'Comptabilité simple'],
                        'is_default' => true
                    ],
                    [
                        'name' => 'Standard',
                        'price_monthly' => 8.00,
                        'price_yearly' => 96.00,
                        'price_local' => 40000.00,
                        'features' => ['Modules Basic', 'Rapports et statistiques', 'CRM', 'Email intégré'],
                        'is_default' => false
                    ],
                    [
                        'name' => 'Premium',
                        'price_monthly' => 12.00,
                        'price_yearly' => 144.00,
                        'price_local' => 60000.00,
                        'features' => ['Modules Standard', 'Comptabilité analytique', 'Suivi de temps', 'KPI automatisés', 'Multi-devises'],
                        'is_default' => false
                    ]
                ]
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'TPE',
                'description' => 'Idéal pour les petites entreprises.',
                'is_free' => false,
                'is_default' => false,
                'instance_limit' => 4,
                'duration_days' => null,
                'has_sub_plans' => true,
                'features' => json_encode([
                    '4 Go de stockage',
                    '2000 appels API'
                ]),
                'sub_plans' => [
                    [
                        'name' => 'Basic',
                        'price_monthly' => 14.50,
                        'price_yearly' => 174.00,
                        'price_local' => 72500.00,
                        'features' => ['Modules Basic'],
                        'is_default' => true
                    ],
                    [
                        'name' => 'Standard',
                        'price_monthly' => 18.00,
                        'price_yearly' => 216.00,
                        'price_local' => 90000.00,
                        'features' => ['Modules Basic', 'Modules Standard'],
                        'is_default' => false
                    ],
                    [
                        'name' => 'Premium',
                        'price_monthly' => 22.00,
                        'price_yearly' => 264.00,
                        'price_local' => 110000.00,
                        'features' => ['Modules Basic', 'Modules Standard', 'Modules Premium'],
                        'is_default' => false
                    ]
                ]
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Association',
                'description' => 'Conçu pour la gestion des associations.',
                'is_free' => false,
                'is_default' => false,
                'instance_limit' => 10,
                'duration_days' => null,
                'has_sub_plans' => true,
                'features' => json_encode([
                    '4 Go de stockage',
                    '2000 appels API'
                ]),
                'sub_plans' => [
                    [
                        'name' => 'Basic',
                        'price_monthly' => 19.00,
                        'price_yearly' => 228.00,
                        'price_local' => 95000.00,
                        'features' => ['Gestion des adhésions'],
                        'is_default' => true
                    ],
                    [
                        'name' => 'PME Standard',
                        'price_monthly' => 25.00,
                        'price_yearly' => 300.00,
                        'price_local' => 125000.00,
                        'features' => ['Paiement, suivi, relance des cotisations'],
                        'is_default' => false
                    ]
                ]
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Entreprise',
                'description' => 'Offre complète pour les grandes entreprises.',
                'is_free' => false,
                'is_default' => false,
                'instance_limit' => null,
                'duration_days' => null,
                'has_sub_plans' => true,
                'features' => json_encode([
                    '100 Go de stockage',
                    '10 000 appels API'
                ]),
                'sub_plans' => [
                    [
                        'name' => 'RH',
                        'price_monthly' => 39.90,
                        'price_yearly' => 478.80,
                        'price_local' => 195000.00,
                        'features' => ['Gestion des RH'],
                        'is_default' => true
                    ],
                    [
                        'name' => 'GPEC',
                        'price_monthly' => 45.00,
                        'price_yearly' => 540.00,
                        'price_local' => 225000.00,
                        'features' => ['GPEC'],
                        'is_default' => false
                    ],
                    [
                        'name' => 'Paie',
                        'price_monthly' => 50.00,
                        'price_yearly' => 600.00,
                        'price_local' => 250000.00,
                        'features' => ['Paie'],
                        'is_default' => false
                    ]
                ]
            ]
        ];

        foreach ($plans as $plan) {
            $subPlans = $plan['sub_plans'];
            unset($plan['sub_plans']);
            
            $planId = DB::table('plans')->insertGetId($plan);

            foreach ($subPlans as $subPlan) {
                DB::table('sub_plans')->insert([
                    'plan_id' => $planId,
                    'name' => $subPlan['name'],
                    'price_monthly' => $subPlan['price_monthly'],
                    'price_yearly' => $subPlan['price_yearly'],
                    'price_local' => $subPlan['price_local'],
                    'features' => json_encode($subPlan['features']),
                    'is_default' => $subPlan['is_default'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}