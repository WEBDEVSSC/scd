<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AreasNivel;

class AreasNivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AreasNivel::insert([
            ['nivel' => 'DESPACHO'],
            ['nivel' => 'SUBSECRETARIA'],
            ['nivel' => 'SUBDIRECCION'],
            ['nivel' => 'JEFATURA'],
            ['nivel' => 'AREA'],
            ['nivel' => 'UNIDAD'],
        ]);
    }
}
