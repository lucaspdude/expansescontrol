<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Categoria;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {




            // ROLES AND PERMISSIONS

            $superAdmin = factory(User::class)->create([
                'name' => 'Administrador',
                'email' => 'superadmin@aplicativo.com',
                'password' => Hash::make('123456789')
            ]);


            $administrador = Role::create(['name'=> 'Administrador']);
            $usuario = Role::create(['name'=> 'Usuario']);


            $superAdmin->assignRole('Administrador');




            $usuarios = factory(User::class, 5000)->create([
            ])->each(function($usuario){
                $usuario->assignRole('Usuario');
            });


    }
}
