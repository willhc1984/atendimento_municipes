<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'henrique@votorantim.sp.leg.br')->first()){
            $superAdmin = User::create([
                'name' => 'william',
                'email' => 'henrique@votorantim.sp.leg.br',
                'password' => Hash::make('123', ['rounds' => 10])
            ]);
            
            //Atribuir papel ao usuario
            $superAdmin->assignRole('Super Admin');
        }

        if(!User::where('email', 'paula@votorantim.sp.leg.br')->first()){
            $recepcionista = User::create([
                'name' => 'paula',
                'email' => 'recepcao@votorantim.sp.leg.br',
                'password' => Hash::make('123', ['rounds' => 10])
            ]);
            
            //Atribuir papel ao usuario
            $recepcionista->assignRole('Recepcionista');
        }
    }
}
