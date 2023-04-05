<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-show',
            'role-trashed',
            'role-trashed-restore',
            'role-trashed-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'category-show',
            'category-trashed',
            'category-trashed-restore',
            'category-trashed-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-show',
            'user-trashed',
            'user-trashed-restore',
            'user-trashed-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'product-show',
            'product-trashed',
            'product-trashed-restore',
            'product-trashed-delete',
            

         ];
       
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
