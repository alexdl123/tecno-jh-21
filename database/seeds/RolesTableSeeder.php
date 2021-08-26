<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'editar categoria']);
        Permission::create(['name' => 'eliminar categoria']);
        Permission::create(['name' => 'crear categoria']);
        Permission::create(['name' => 'ver categoria']);

        Permission::create(['name' => 'ver bitacora']);

        Permission::create(['name' => 'editar plan']);
        Permission::create(['name' => 'eliminar plan']);
        Permission::create(['name' => 'crear plan']);
        Permission::create(['name' => 'ver plan']);

        Permission::create(['name' => 'editar habitacion']);
        Permission::create(['name' => 'eliminar habitacion']);
        Permission::create(['name' => 'crear habitacion']);
        Permission::create(['name' => 'ver habitacion']);

        Permission::create(['name' => 'editar huesped']);
        Permission::create(['name' => 'eliminar huesped']);
        Permission::create(['name' => 'crear huesped']);
        Permission::create(['name' => 'ver huesped']);

        Permission::create(['name' => 'editar personal']);
        Permission::create(['name' => 'eliminar personal']);
        Permission::create(['name' => 'crear personal']);
        Permission::create(['name' => 'ver personal']);

        Permission::create(['name' => 'ver reporte']);

        Permission::create(['name' => 'eliminar reserva']);
        Permission::create(['name' => 'crear reserva']);
        Permission::create(['name' => 'ver reserva']);

        Permission::create(['name' => 'editar promocion']);
        Permission::create(['name' => 'eliminar promocion']);
        Permission::create(['name' => 'crear promocion']);
        Permission::create(['name' => 'ver promocion']);

        Permission::create(['name' => 'modulo usuario']);
        Permission::create(['name' => 'modulo seguridad']);
        Permission::create(['name' => 'modulo hotel']);

        $role = Role::create(['name' => 'administrador']);
        // $role->givePermissionTo(Permission::all());
        $role->givePermissionTo(['ver categoria', 'crear categoria', 'editar categoria', 'eliminar categoria']);
        $role->givePermissionTo(['ver bitacora']);
        $role->givePermissionTo(['ver plan', 'crear plan', 'editar plan', 'eliminar plan']);
        $role->givePermissionTo(['ver habitacion', 'crear habitacion', 'editar habitacion', 'eliminar habitacion']);
        $role->givePermissionTo(['ver huesped', 'crear huesped', 'editar huesped', 'eliminar huesped']);
        $role->givePermissionTo(['ver personal', 'crear personal', 'editar personal', 'eliminar personal']);
        $role->givePermissionTo(['ver promocion', 'crear promocion', 'editar promocion', 'eliminar promocion']);
        $role->givePermissionTo(['ver reserva', 'crear reserva', 'eliminar reserva']);
        $role->givePermissionTo(['ver reporte']);
        $role->givePermissionTo(['modulo usuario']);
        $role->givePermissionTo(['modulo seguridad']);
        $role->givePermissionTo(['modulo hotel']);

        $role = Role::create(['name' => 'recepcionista']);
        $role->givePermissionTo(['modulo usuario']);
        $role->givePermissionTo(['modulo hotel']);
        $role->givePermissionTo(['ver reserva', 'crear reserva', 'eliminar reserva']);
        $role->givePermissionTo(['ver huesped', 'crear huesped', 'editar huesped', 'eliminar huesped']);
        // $role->givePermissionTo(Permission::all());
        //$role->givePermissionTo(['ver categoria', 'crear categoria', 'editar categoria', 'eliminar categoria']);
        $role = Role::create(['name' => 'cliente']);
        $role->givePermissionTo(['ver reserva']);
        $role->givePermissionTo(['modulo hotel']);
        // $role->givePermissionTo(Permission::all());
        //$role->givePermissionTo(['ver categoria', 'crear categoria', 'editar categoria', 'eliminar categoria']);
    }
}
