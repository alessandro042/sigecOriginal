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
                'id' => 200,
                'id_rol' => 11,
                'nombre_completo' => 'Ing. Roberto Pablo López Romero',
                
                'username' => 'robertoplr',
                'email' => 'roberto.lopez@uaem.mx',
                'password' => Hash::make('Temporal123')
            ],
            [
                'id' => 201,
                'id_rol' => 11,
                'nombre_completo' => 'Carlos Eduardo Delgado Domínguez',
                
                'username' => 'LaloD',
                'email' => '20223tn152@utez.edu.mx',
                'password' => Hash::make('12345678')
            ],
            [
                'id' => 202,
                'id_rol' => 11,
                'nombre_completo' => 'Juan Diego González Hernández',
                
                'username' => 'JuanDiego',
                'email' => '20223tn127@utez.edu.mx',
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
                'nombre_completo' => 'Jovanna Jatziry Herrera Hernández',
               
                'username' => 'Jatziry',
                'email' => '20223tn062@utez.edu.mx',
                'password' => Hash::make('12345678')
            ],
            [
                'id' => 205,
                'id_rol' => 12,
                'nombre_completo' => 'Prueba 1 de Editor',
              
                'username' => 'prueba1Editor',
                'email' => 'prueba1Editor@gmail.com',
                'password' => Hash::make('12345678')
            ],
        ]);
    }
}
