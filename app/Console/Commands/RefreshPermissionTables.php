<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class RefreshPermissionTables extends Command
{
    protected $signature = 'migrate:refresh-permissions';
    protected $description = 'Refresh the roles and permissions tables';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // List of tables to refresh
        $tables = [
            'model_has_permissions',
            'model_has_roles',
            'role_has_permissions',
            'roles',
            'permissions',
        ];

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop tables
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Run migrations for the specific tables
        Artisan::call('migrate', [
            '--path' => 'database/migrations',
            '--force' => true,
        ]);

        // Reseed the tables
        Artisan::call('db:seed', [
            '--class' => 'RolesAndPermissionsSeeder',
            '--force' => true,
        ]);

        $this->info('Roles and permissions tables have been refreshed.');
    }
}
