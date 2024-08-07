<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_user = new User();
        $admin_user->name='Fatlinda';
        $admin_user->email='fatlindabrahaj@gmail.com';
        $admin_user->password=Hash::make('password');
        $admin_user->save();

        $admin_user->assignRole('admin');

        
    }
}
