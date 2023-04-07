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

        $permission = Permission::create(['name' => 'prueba'])->syncRoles([$role1, $role2]);
        /*--------------------------------------------------------------------------------*/
        $permission = Permission::create(['name' => 'products.index'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'products.create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.store'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.show'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'products.edit'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.update'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.destroy'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'products.deactivate'])->syncRoles([$role1, $role2]);
        
        $permission = Permission::create(['name' => 'categories.index'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'categories.create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'categories.store'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'categories.show'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'categories.edit'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'categories.update'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'categories.destroy'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'users.index'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.store'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.show'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.edit'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.update'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.destroy'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'users.editrol'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'enviarPeticion'])->syncRoles([$role3]);
        
    }
}
