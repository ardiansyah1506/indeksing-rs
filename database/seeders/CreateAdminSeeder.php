<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminSeeder extends Seeder
{
    public function run(): void
    {
            $user = User::create([
                'name' => 'admin', 
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456')
            ]);
            
            $role = Role::create(['name' => 'Admin']);
             
            $permissions = Permission::pluck('id','id')->all();
           
            $role->syncPermissions($permissions);
             
            $user->assignRole([$role->id]);
    }
}
