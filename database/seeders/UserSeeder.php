<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user Petugas
        $user = User::updateOrCreate(
            ['email' => 'petugas@mail.com'],
            [
                'name' => 'Petugas',
                'password' => Hash::make('password'),
            ]
        );

        // Menambahkan role ke user
        $role = Role::where('name', 'Petugas')->first();
        if ($role) {
            $user->assignRole($role);
        }

        // Contoh tambahan untuk Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('adminpassword'),
            ]
        );

        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }
    }
}
