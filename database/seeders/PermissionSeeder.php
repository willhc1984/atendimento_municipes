<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'index-municipes', 'create-municipes', 
            'show-municipes', 'edit-municipes', 'destroy-municipes',
            'index-atendimentos', 'create-atendimentos', 
            'show-atendimentos', 'edit-atendimentos', 'destroy-atendimentos',
            'index-vereadores', 'create-vereadores', 
            'show-vereadores', 'edit-vereadores', 'destroy-vereadores',
            'index-users', 'show-users', 'edit-users', 'create-users', 'destroy-users'

        ];

        foreach($permissions as $permission){
            $existingPermission = Permission::where('name', $permission)->first();

            if(!$existingPermission){
                Permission::create(['name' => $permission, 'guard_name' => 'web']);
            }
        }
    }
}
