<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Petugas', 'User']; // Tambahkan role sesuai kebutuhan

        foreach ($roles as $roleName) {
            Role::updateOrCreate(['name' => $roleName], ['guard_name' => 'web']);
        }
    }
}
