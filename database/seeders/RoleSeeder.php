<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $role = new Role();
        $role->name = Role::ROLE_ADMIN;
        $role->save();

        $role2 = new Role();
        $role2->name = Role::ROLE_USER;
        $role2->save();
    }
}
