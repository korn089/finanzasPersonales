<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Sergio',
            'email' => 'sergio@gmail.com',
            'password' => Hash::make('Sergio089'),
        ]);
        User::factory()->create([
            'name' => 'Jarly',
            'email' => 'jarly@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        User::factory()->create([
            'name' => 'Ailin',
            'email' => 'ailin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        User::factory()->create([
            'name' => 'Cristopher',
            'email' => 'cristopher@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        Categoria::create(['nombre'=>'Alimentacion', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Transporte', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Salud', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Entretenimiento', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Sueldos', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Inversiones', 'tipo'=>'ingreso']);
        Categoria::create(['nombre'=>'Otros', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Ahorros', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Otros Ingresos', 'tipo'=>'ingreso']);
        Categoria::create(['nombre'=>'Otros Gastos', 'tipo'=>'gasto']);

    }
}
