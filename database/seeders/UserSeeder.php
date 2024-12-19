<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
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
        ModelsUser::create([
            'name' => 'Administrador', // Cambia si necesitas otro nombre
            'email' => 'soportewebssc@gmail.com',
            'password' => Hash::make('12345'), // Hasheamos la contraseña
            'role' => 'admin', // Asegúrate de que el campo `role` existe en tu tabla
        ]);
    }
}
