<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'writer']);
        // Role::create(['name' => 'user']);

        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'export user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'visit logs']);

        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('create user');
        $role1->givePermissionTo('edit user');
        $role1->givePermissionTo('delete user');
        $role1->givePermissionTo('export user');
        $role1->givePermissionTo('update user');
        $role1->givePermissionTo('visit logs');

        $role2 = Role::create(['name' => 'editor']);
        $role2->givePermissionTo('edit user');
        $role2->givePermissionTo('update user');

        $role3 = Role::create(['name' => 'user']);
    }
}
