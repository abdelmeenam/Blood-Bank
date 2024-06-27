<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CreatePermissions;
use Database\Seeders\CreateAdminUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(CreateRoles::class);
        //$this->call(CreatePermissions::class);
        //$this->call(CreateAdminUserSeeder::class);

        //$this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);

        //to call this seeder, run php artisan db:seed --class=DatabaseSeeder
    }
}