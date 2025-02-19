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

        DB::table('pacientes')->insert([
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '1001234567',
                'nombre1' => 'Juan',
                'nombre2' => 'Carlos',
                'apellido1' => 'Pérez',
                'apellido2' => 'Gómez',
                'genero_id' => 1,
                'departamento_id' => 1,
                'municipio_id' => 1,
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento' => '1029384756',
                'nombre1' => 'María',
                'nombre2' => null,
                'apellido1' => 'Rodríguez',
                'apellido2' => 'López',
                'genero_id' => 2,
                'departamento_id' => 2,
                'municipio_id' => 3,
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '1109876543',
                'nombre1' => 'Carlos',
                'nombre2' => 'Eduardo',
                'apellido1' => 'Martínez',
                'apellido2' => null,
                'genero_id' => 1,
                'departamento_id' => 3,
                'municipio_id' => 5,
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '1205647382',
                'nombre1' => 'Ana',
                'nombre2' => 'Isabel',
                'apellido1' => 'González',
                'apellido2' => 'Torres',
                'genero_id' => 2,
                'departamento_id' => 4,
                'municipio_id' => 7,
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '1309876123',
                'nombre1' => 'Samuel',
                'nombre2' => null,
                'apellido1' => 'Fernández',
                'apellido2' => 'Díaz',
                'genero_id' => 3,
                'departamento_id' => 5,
                'municipio_id' => 9,
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
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
