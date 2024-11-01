<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // List
            'user-list',
            'role-list',
            'training-list',
            'sertifikat-list',

            // Edit
            'user-edit',
            'role-edit',
            'training-edit',
            'sertifikat-edit',
            
            // Create
            'user-create',
            'role-create',
            'training-create',
            'sertifikat-create',
            
            // Delete
            'user-delete',
            'role-delete',
            'training-delete',
            'sertifikat-delete',

            //Export
            'sertifikat-export',
            
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
