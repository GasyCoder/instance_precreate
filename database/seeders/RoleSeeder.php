<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'client' => [
                'label' => 'Client',
                'description' => 'Client ERP',
                'permissions' => [
                    'view_profile',
                    'update_profile',
                    'view_subscription',
                    'view_instance'
                ],
            ],
        ];

        foreach ($roles as $roleName => $roleData) {
            $role = Role::create([
                'name' => $roleName,
                'label' => $roleData['label'],
                'description' => $roleData['description'],
                'guard_name' => 'web',
            ]);

            if (!empty($roleData['permissions'])) {
                foreach ($roleData['permissions'] as $permission) {
                    if (Permission::where('name', $permission)->exists()) {
                        $role->givePermissionTo($permission);
                        echo "Assigned permission {$permission} to role {$roleName}\n";
                    } else {
                        echo "Warning: Permission {$permission} does not exist\n";
                    }
                }
            }
        }
    }
}
