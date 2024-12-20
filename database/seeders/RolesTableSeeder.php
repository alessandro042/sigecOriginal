<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 11, 'rol' => 'Administrador'],
            ['id' => 12, 'rol' => 'Empleado'],
            ['id' => 13, 'rol' => 'consultor'],
        ]);
    }
}
