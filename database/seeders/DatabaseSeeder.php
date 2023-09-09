<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        Permission::create(['name' => 'admin']);
    
        // Create roles and assign permissions
        Role::create(['name' => 'admin'])
            ->givePermissionTo('admin');
    }
}
