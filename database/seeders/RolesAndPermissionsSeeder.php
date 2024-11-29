<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfPermissionNames = [
            'organization-create','organization-edit','organization-delete','organization-view',
            'school-create','school-edit','school-delete','school-view',
            'student-create','student-edit','student-delete','student-view',
            'grade-create','grade-edit','grade-delete','grade-view',
            'role-create','role-edit','role-delete','role-view',
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function($permission){
            return ['name' => $permission , 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        $role = Role::create(['name'=>'admin' ,'guard_name' => 'web'])
            ->givePermissionTo($arrayOfPermissionNames);
    }
}
