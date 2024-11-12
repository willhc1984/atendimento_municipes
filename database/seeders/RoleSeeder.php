<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Role::where('name', 'Super Admin')->first()){
            Role::create([
                'name' => 'Super Admin'
            ]);
        }

        if(!Role::where('name', 'Admin')->first()){
            $admin = Role::create([
                'name' => 'Admin'
            ]);

            $admin->givePermissionTo([
                'index-municipes', 'create-municipes', 
                'show-municipes', 'edit-municipes', 'destroy-municipes',
                'index-vereadores', 'create-vereadores', 
                'show-vereadores', 'edit-vereadores', 'destroy-vereadores',
                'index-atendimentos', 'create-atendimentos', 
                'show-atendimentos', 'edit-atendimentos', 'destroy-atendimentos',
            ]);
        }

        if(!Role::where('name', 'Recepcionista')->first()){
            $recepcionista = Role::create([
                'name' => 'Recepcionista'
            ]);

            $recepcionista->givePermissionTo([
                'index-municipes', 'create-municipes', 
                'show-municipes', 'edit-municipes', 'destroy-municipes',
                'index-atendimentos', 'create-atendimentos', 
                'show-atendimentos', 'edit-atendimentos', 'destroy-atendimentos'
            ]);
        }
    }
}
