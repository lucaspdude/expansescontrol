<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = factory(User::class, 20)->create([
            'tipo' => 'usuario',
        ]);
    }
}
