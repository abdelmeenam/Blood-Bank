<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $this->createAdminUser();
        $this->createEditorUser();
        $this->createViewerUser();
    }

    protected function createAdminUser()
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => 'password'
            ]
        );
        $admin->assignRole('admin');
    }

    protected function createEditorUser()
    {
        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor User',
                'password' => 'password'
            ]
        );
        $editor->assignRole('editor');
    }

    protected function createViewerUser()
    {
        $viewer = User::firstOrCreate(
            ['email' => 'viewer@example.com'],
            [
                'name' => 'Viewer User',
                'password' => 'password'
            ]
        );
        $viewer->assignRole('viewer');
    }
}
