<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // Insertar Departamentos
        DB::table('departamentos')->insert([
            ['nombre' => 'Antioquia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Cundinamarca', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Valle del Cauca', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Santander', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Bolívar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Insertar Municipios
        DB::table('municipios')->insert([
            ['departamento_id' => 1, 'nombre' => 'Medellín', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['departamento_id' => 1, 'nombre' => 'Bello', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['departamento_id' => 2, 'nombre' => 'Bogotá', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['departamento_id' => 2, 'nombre' => 'Soacha', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['departamento_id' => 3, 'nombre' => 'Cali', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['departamento_id' => 3, 'nombre' => 'Palmira', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['departamento_id' => 4, 'nombre' => 'Bucaramanga', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['departamento_id' => 4, 'nombre' => 'Floridablanca', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['departamento_id' => 5, 'nombre' => 'Cartagena', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['departamento_id' => 5, 'nombre' => 'Turbaco', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);


       // Insertar Géneros
        DB::table('generos')->insert([
            ['nombre' => 'Masculino', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Femenino', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Otro', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Insertar Tipos de Documento
        DB::table('tipos_documento')->insert([
            ['nombre' => 'Cédula de Ciudadanía', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Tarjeta de Identidad', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Insertar Usuario Administrador
        DB::table('users')->insert([
            'tipo_documento_id' => 1,
            'numero_documento' => '123456789',
            'name' => 'Admin',
            'password' => Hash::make('1234567890'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
