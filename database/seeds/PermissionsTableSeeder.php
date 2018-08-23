<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Roles Creacion
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


        //Alumno
        Permission::create([
          'name'        => 'Navegar Alumno',
          'slug'        => 'alumno.index',
          'description' => 'Lista y Navega los Justificativos creados por el usuario',
        ]);

        Permission::create([
          'name'        => 'Crear justificativo',
          'slug'        => 'justificacion.create',
          'description' => 'Alumno crea justificativo',
        ]);

        Permission::create([
          'name'        => 'Ver detalle del justificativo',
          'slug'        => 'justificacion.show',
          'description' => 'Alumno ve detalle justificativo',
        ]);

        //Coordinador

        Permission::create([
          'name'        => 'Navegar Coordinador',
          'slug'        => 'coordinador.index',
          'description' => 'Lista y Navega los justificativos asignados al Coordinador',
        ]);

        Permission::create([
          'name'        => 'Edicion de Justificativos',
          'slug'        => 'coordinador.edit',
          'description' => 'Edicion de justificativo enviado por el alumno',
        ]);


        //Roles Definicion Permisos

        Permission::create([
          'name'        => 'Navegar Roles',
          'slug'        => 'roles.index',
          'description' => 'Lista y Navega los roles',
        ]);

        Permission::create([
          'name'        => 'Crear Roles',
          'slug'        => 'roles.create',
          'description' => 'Creacion de roles',
        ]);

        Permission::create([
          'name'        => 'Ver detalle de Roles',
          'slug'        => 'roles.show',
          'description' => 'Ver en detalle un rol',
        ]);

        Permission::create([
          'name'        => 'Edicion de Roles',
          'slug'        => 'roles.edit',
          'description' => 'Edicion de roles',
        ]);

        Permission::create([
          'name'        => 'Elimincion de Roles',
          'slug'        => 'roles.destroy',
          'description' => 'Eliminacion de roles',
        ]);


        //asociando permiso a rol
        $role = Role::find(2);
        $role->assignPermission(1);
        $role->assignPermission(2);
        $role->assignPermission(3);
        $role->save();

        $role = Role::find(3);
        $role->assignPermission(3);
        $role->assignPermission(4);
        $role->assignPermission(5);
        $role->save();
    }
}
