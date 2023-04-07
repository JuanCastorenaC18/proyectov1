<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Supervisor']);
        $role3 = Role::create(['name' => 'Client']);

        $permission = Permission::create(['name' => 'prueba', 'description' => 'Ver pantalla de prueba'])->syncRoles([$role1, $role2]);
        /*--------------------------------------------------------------------------------*/
        $permission = Permission::create(['name' => 'products.index', 
                                        'description' => 'Ver pantalla de productos'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'products.create', 
                                        'description' => 'crear producto'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.store', 
                                        'description' => 'guardar producto'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.show', 
                                        'description' => 'ver productos completo'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'products.edit', 
                                        'description' => 'ir a editar producto'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.update', 
                                        'description' => 'actualizar producto'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.destroy', 
                                        'description' => 'desactivar producto'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.deactivate', 
                                        'description' => ''])->syncRoles([$role1, $role2]);
        
        $permission = Permission::create(['name' => 'categories.index', 
                                        'description' => 'Ver pantalla de categorias'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'categories.create', 
                                        'description' => 'crear categorias'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'categories.store', 
                                        'description' => 'guardar producto'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'categories.show', 
                                        'description' => 'ver productos completo'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'categories.edit', 
                                        'description' => 'ir a editar producto'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'categories.update', 
                                        'description' => 'actualizar producto'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'categories.destroy', 
                                        'description' => 'desactivar producto'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'users.index', 
                                        'description' => 'Ver pantalla de usuarios'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.create',
                                        'description' => 'crear usuarios'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.store',
                                        'description' => 'crear usuarios'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.show',
                                        'description' => 'crear usuarios'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.edit',
                                        'description' => 'crear usuarios'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.update',
                                        'description' => 'crear usuarios'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.destroy',
                                        'description' => 'crear usuarios'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.editpermiso',
                                        'description' => 'crear usuarios'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'enviarPeticion',
                                        'description' => 'crear usuarios'])->syncRoles([$role3]);
        
    }
}
