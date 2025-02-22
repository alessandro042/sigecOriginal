<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('usuarios')->insert([
            [
                'id' => 201,
                'id_rol' => 11,
                'nombre_completo' => 'Abril García Bustos',
                'username' => 'April',
                'email' => '20223tn053@utez.edu.mx',
                'password' => Hash::make('12345678')
            ],
            [
                'id' => 202,
                'id_rol' => 11,
                'nombre_completo' => 'José Antonio Díaz García',
                'username' => 'Antoine',
                'email' => '20223tn047@utez.edu.mx',
                'password' => Hash::make('12345678')
            ],
            [
                'id' => 203,
                'id_rol' => 11,
                'nombre_completo' => 'Alejandro Hernández Díaz',
               
                'username' => 'alessandroo',
                'email' => '20223tn058@utez.edu.mx',
                'password' => Hash::make('12345678')
            ],
            [
                'id' => 204,
                'id_rol' => 11,
                'nombre_completo' => 'Irving Uriel Espinosa Hernández',
               
                'username' => 'Irv',
                'email' => '20223tn062@utez.edu.mx',
                'password' => Hash::make('12345678')
            ],
        ]);
    }
}
