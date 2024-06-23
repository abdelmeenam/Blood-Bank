<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{


    private $allPermissions = [
        'read_users',
        'create_users',
        'edit_users',
        'update_users',
        'delete_users',

        'read_roles',
        'create_roles',
        'update_roles',
        'edit_roles',
        'delete_roles',

        'read_permissions',
        'create_permissions',
        'update_permissions',
        'edit_permissions',
        'delete_permissions',

        'read_posts',
        'create_posts',
        'update_posts',
        'edit_posts',
        'delete_posts',

        'read_clients',
        'create_clients',
        'update_clients',
        'edit_clients',
        'delete_clients',

        'read_settings',
        'edit_settings',
        'update_settings',

        'read_donations',
        'delete_donations',
        'edit_donations',
        'create_donations',
        'update_donations',

        'read_governorates',
        'create_governorates',
        'update_governorates',
        'delete_governorates',
        'read_cities',
        'create_cities',
        'update_cities',
        'delete_cities',
        'read_categories',
        'create_categories',
        'update_categories',
        'delete_categories',
    ];

    private $editorPermissions = [
        'create_posts',
        'read_posts',
        'update_posts',
        'delete_posts',
        'read_clients',
        'create_clients',
        'update_clients',
        'delete_clients',
        'read_donations',
        'delete_donations',
        'edit_donations',
        'create_donations',
        'read_governorates',
        'create_governorates',
        'update_governorates',
        'delete_governorates',
        'read_cities',
        'create_cities',
        'update_cities',
        'delete_cities',
        'read_categories',
        'create_categories',
        'update_categories',
        'delete_categories'
    ];

    private $viewerPermissions = [
        'read_clients',
        'read_donations',
        'read_governorates',
        'read_cities',
        'read_categories',
        'read_posts',
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->resetPermissions();
        $this->createPermissions();
        $this->createRoles();
    }

    protected function resetPermissions()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    protected function createPermissions()
    {
        $permissions = $this->allPermissions;
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
    protected function createRoles()
    {
        $roles = [
            'admin' => $this->allPermissions,
            'editor' => $this->editorPermissions,
            'viewer' => $this->viewerPermissions,
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->givePermissionTo($permissions);
        }
    }
}