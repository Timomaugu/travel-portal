<?php

namespace Database\Seeders;

use  App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'manage roles']);

        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);
        Permission::create(['name' => 'manage permissions']);

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'manage users']);

        Permission::create(['name' => 'view request']);
        Permission::create(['name' => 'create request']);
        Permission::create(['name' => 'update request']);
        Permission::create(['name' => 'delete request']);
        Permission::create(['name' => 'process request']);


        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $ceoRole = Role::create(['name' => 'ceo']);
        $directorRole = Role::create(['name' => 'director']);
        $deptAdmRole = Role::create(['name' => 'dept-adm']);
        $hodRole = Role::create(['name' => 'hod-agm-gm']);
        $staffRole = Role::create(['name' => 'staff']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create role', 'view role', 'update role', 'manage roles']);
        $adminRole->givePermissionTo(['create permission', 'view permission', 'manage permissions']);
        $adminRole->givePermissionTo(['create user', 'view user', 'update user', 'manage users']);
        $adminRole->givePermissionTo(['view request', 'process request']);

        // Let's give few permissions to ceo role.
        $ceoRole->givePermissionTo(['view request', 'process request']);

        // Let's give few permissions to director role.
        $directorRole->givePermissionTo(['view request', 'process request']);

        // Let's give few permissions to dept-adm role.
        $directorRole->givePermissionTo(['view request', 'process request']);

        // Let's give few permissions to hod role.
        $hodRole->givePermissionTo(['create role', 'view role', 'update role', 'manage roles']);
        $hodRole->givePermissionTo(['create permission', 'view permission', 'manage permissions']);
        $hodRole->givePermissionTo(['create user', 'view user', 'update user', 'manage users']);
        $hodRole->givePermissionTo(['view request', 'process request']);

        // Let's give few permissions to staff role.
        $staffRole->givePermissionTo(['create request', 'view request', 'update request', 'delete request']);


        // Let's Create User and assign Role to it.

        $superAdminUser = User::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'f_name' => 'Super',
            'l_name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'phone' => '0741675322',
            'password' => Hash::make ('12345678'),
        ]);

        $superAdminUser->assignRole($superAdminRole);


        $adminUser = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'f_name' => 'Admin',
            'l_name' => 'User',
            'email' => 'admin@gmail.com',
            'phone' => '0721695744',
            'password' => Hash::make ('12345678'),
        ]);

        $adminUser->assignRole($adminRole);

        $ceoUser = User::firstOrCreate([
            'email' => 'ceo@gmail.com',
        ], [
            'f_name' => 'CEO',
            'l_name' => 'User',
            'email' => 'ceo@gmail.com',
            'phone' => '0711098678',
            'department_id' => null,
            'password' => Hash::make('12345678'),
        ]);

        $ceoUser->assignRole($ceoRole);

        $directorUser = User::firstOrCreate([
            'email' => 'director@gmail.com',
        ], [
            'f_name' => 'Director',
            'l_name' => 'User',
            'email' => 'director@gmail.com',
            'phone' => '0723765498',
            'department_id' => null,
            'password' => Hash::make('12345678'),
        ]);

        $directorUser->assignRole($directorRole);

        $deptAdmUser = User::firstOrCreate([
            'email' => 'deptadm@gmail.com',
        ], [
            'f_name' => 'DeptAdmin',
            'l_name' => 'User',
            'email' => 'deptadm@gmail.com',
            'phone' => '0728187566',
            'department_id' => 1,
            'password' => Hash::make('12345678'),
        ]);

        $deptAdmUser->assignRole($deptAdmRole);

        $hodUser = User::firstOrCreate([
            'email' => 'hod@gmail.com',
        ], [
            'f_name' => 'Hod',
            'l_name' => 'User',
            'email' => 'hod@gmail.com',
            'phone' => '0741698732',
            'department_id' => 1,
            'password' => Hash::make('12345678'),
        ]);

        $hodUser->assignRole($hodRole);

        $staffUser = User::firstOrCreate([
            'email' => 'staff@gmail.com',
        ], [
            'f_name' => 'Staff',
            'l_name' => 'User',
            'email' => 'staff@gmail.com',
            'phone' => '0745369587',
            'department_id' => 1,
            'password' => Hash::make('12345678'),
        ]);

        $staffUser->assignRole($staffRole);
    }
}