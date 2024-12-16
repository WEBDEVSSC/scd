<?php

namespace Database\Seeders;

use App\Models\UsersNivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserNivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          //
          UsersNivel::insert([
            ['nivel' => 'SECRETARIO'],
            ['nivel' => 'SUBSECRETARIO'],
            ['nivel' => 'SUBDIRECTOR'],
            ['nivel' => 'JEFE DE DEPARTAMENTO'],
            ['nivel' => 'OPERATIVO'],
            ['nivel' => 'TITULAR'],
        ]);
    }
}
