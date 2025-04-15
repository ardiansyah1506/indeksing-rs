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
            'view-role',
            'role-create',
            'role-edit',
            'role-delete',
            'view-user',
            'add-user',
            'edit-user',
            'delete-user',
            'add-indeks',
            'edit-indeks',
            'delete-indeks',
            'cetak-indeks',
            'view-icd10',
            'add-icd10',
            'edit-icd10',
            'view-icd9',
            'add-icd9',
            'edit-icd9',
            'delete-icd10',
            'delete-icd9',
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
