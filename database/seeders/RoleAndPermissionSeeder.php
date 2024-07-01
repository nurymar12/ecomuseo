<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'create-component',
            'edit-component',
            'delete-component',
            'create-tour',
            'edit-tour',
            'delete-tour',
            'edit-visit',
            'delete-visit',
            'create-blog',
            'edit-blog',
            'delete-blog',
            'approve_post',
            'create-donation',
            'edit-donation',
            'delete-donation',
         ];

          // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $visitor = Role::create(['name' => 'Visitor']);
        $volunteerRole = Role::create(['name' => 'Volunteer']);

        $superAdmin->givePermissionTo([
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'create-component',
            'edit-component',
            'delete-component',
            'create-tour',
            'edit-tour',
            'delete-tour',
            'edit-visit',
            'delete-visit',
            'create-blog',
            'edit-blog',
            'delete-blog',
            'approve_post'

        ]);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-component',
            'edit-component',
            'delete-component',
            'edit-visit',
            'delete-visit',
            'create-blog',
            'edit-blog',
            'delete-blog',
            'approve_post'
        ]);

        $volunteerRole->givePermissionTo([
            'create-component',
            'edit-component',
            'delete-component',
            'create-blog',
            'edit-blog',
            'delete-blog',
            'create-tour',
            'edit-tour',
            'delete-tour',
            'create-donation',
            'edit-donation',
            'delete-donation',
        ]);

        // Permission::create(['name' => 'view-pages']);

        // Permission::create(['name' => 'create-users']);
        // Permission::create(['name' => 'edit-users']);
        // Permission::create(['name' => 'delete-users']);

        // Permission::create(['name' => 'create-blog-posts']);
        // Permission::create(['name' => 'edit-blog-posts']);
        // Permission::create(['name' => 'delete-blog-posts']);

        // $userRole = Role::create(['name' => 'Visitor']);
        // $adminRole = Role::create(['name' => 'Admin']);
        // $volunteerRole = Role::create(['name' => 'Volunteer']);

        // $userRole->givePermissionTo([
        //     'view-pages',
        // ]);

        // $adminRole->givePermissionTo([
        //     'create-users',
        //     'edit-users',
        //     'delete-users',
        //     'create-blog-posts',
        //     'edit-blog-posts',
        //     'delete-blog-posts',
        // ]);

        // $volunteerRole->givePermissionTo([
        //     'create-blog-posts',
        //     'edit-blog-posts',
        //     'delete-blog-posts',
        // ]);

        // $user = User::first();

        // $user->assignRole('Super Admin');

        // $users = User::all();
        // if ($users->isNotEmpty()) {
        //     $users->first()->assignRole($superAdmin); // Asigna el rol de Admin al primer usuario

        //     // Asigna el rol de Visitor a todos los demás usuarios
        //     $users->slice(1)->each(function ($user) use ($admin) {
        //         $user->assignRole($admin);
        //     });
        // }

    }
}
