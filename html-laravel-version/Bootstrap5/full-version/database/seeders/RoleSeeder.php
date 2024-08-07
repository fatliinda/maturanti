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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
       
        $manage_quizzes_permission = Permission::create(['name' => 'manage quizzes']);
        $take_quizzes_permission = Permission::create(['name' => 'take quizzes']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);
        $admin->givePermissionTo($manage_quizzes_permission);
        $user->givePermissionTo($take_quizzes_permission);
    }
   
}
