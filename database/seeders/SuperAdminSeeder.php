<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Super Admin',
            'email'    => 'superadmin@leoni.com',
            'password' => Hash::make('superadmin123'),
            'role'     => 'super_admin',
            'site_id'  => null, // super admin doesn't belong to a specific site
        ]);
    }
}
