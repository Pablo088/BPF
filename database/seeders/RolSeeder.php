<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'Admin']);
        $role2 = Role::create(['name'=>'User']);

        
        Permission::create(['name' => 'bus-stops.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'bus-stops.admin'])->assignRole($role1);
        Permission::create(['name' => 'bus-stops.eliminar'])->assignRole($role1);
        Permission::create(['name' => 'bus-stops.editar'])->assignRole($role1);
        Permission::create(['name' => 'bus-stops.route'])->assignRole($role1);
        Permission::create(['name' => 'bus-stops.routes.eliminar'])->assignRole($role1);
    }
    
}
