<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        // $adminRole->givePermissionTo('all');

        $admin = User::find(151);
        $admin->assignRole('super_admin');
        $this->call([
        //    AdminSeeder::class,
            // RoleAndPermissionSeeder::class,

        ]);
    }
}
