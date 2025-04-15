<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'add-indeks',
            'edit-indeks',
            'cetak-indeks',
            'view-akses',
            'add-akses',
            'edit-akses',
            'delete-akses',
            'view-poli',
            'add-poli',
            'edit-poli',
            'delete-poli',
            'view-dokter',
            'add-dokter',
            'edit-dokter',
            'delete-dokter',
           
         ];
         
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
