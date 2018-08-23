<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


      Role::create([
        'name'    => 'Admin',
        'slug'    => 'admin',
        'special' => 'all-access',
      ]);

      Role::create([
        'name'        => 'Alumno',
        'slug'        => 'alumno',
        'description' => 'Usuario creador de justificativos',
      ]);

      Role::create([
        'name'        => 'Coordinador',
        'slug'        => 'coordinador',
        'description' => 'Usuario editor de justificativos',
      ]);
    }
}
