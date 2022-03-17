<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'Admin'
        ]);

        Role::create([
            'name' => 'Teacher'
        ]);
        
        Role::create([
            'name' => 'Student'
        ]);
        
        Role::create([
            'name' => 'Guest'
        ]);
    }
}
