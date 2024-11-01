<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
    [
        'id' => 1,
        'nama_role' => 'admin',
        'deskripsi_role' => 'Administrator with limited access to manage users and oversee activities.',
    ],
    [
        'id' => 2,
        'nama_role' => 'superadmin',
        'deskripsi_role' => 'Super Administrator with full access to manage all roles and settings.',
    ],
]);

    }
}
