<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'User'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $permissions = [
            'blog-list',
            'blog-create',
            'blog-edit',
            'blog-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::where('name', 'Admin')->first();

        $role->syncPermissions($permissions);

        $user_permissions = [
            'blog-list',
            'blog-create',
            'blog-edit'
        ];

        $role = Role::where('name', 'User')->first();

        $role->syncPermissions($user_permissions);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' =>  Hash::make('123456')
        ]);
        $user->assignRole('Admin');
    }
}
