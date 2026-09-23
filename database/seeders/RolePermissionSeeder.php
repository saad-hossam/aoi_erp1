<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  // Permissions
    Permission::create(['name' => 'create users']);
    Permission::create(['name' => 'edit users']);
    Permission::create(['name' => 'delete users']);
    Permission::create(['name' => 'view users']);

    // Roles
    $admin = Role::create(['name' => 'admin']);
    $editor = Role::create(['name' => 'editor']);

    // Assign Permissions to Roles
    $admin->givePermissionTo(Permission::all());
    $editor->givePermissionTo(['view users']);    }
}
