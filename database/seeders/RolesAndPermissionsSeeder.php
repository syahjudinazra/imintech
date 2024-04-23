<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions
        $permissions = [
            // Stocks permissions
            'edit stocks', 'delete stocks', 'create stocks',
            // Pinjams permissions
            'edit pinjams', 'delete pinjams', 'create pinjams', 'move pinjams',
            // Services permissions
            'create services', 'edit services antrian', 'delete services antrian',
            'move services antrian', 'edit services validasi', 'delete services validasi',
            'move services validasi', 'edit services selesai', 'delete services selesai',
            // Spareparts permissions
            'edit spareparts', 'delete spareparts', 'create spareparts',
            'create quantity spareparts', 'reduce quantity spareparts',
            // Firmwares permissions (Assuming this was a copy-paste mistake)
            'edit firmwares', 'delete firmwares', 'create firmwares',
            // Users permissions
            'edit users', 'delete users', 'create users',
        ];

        // Create all permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Define roles and assign permissions
        $roles = [
            // Superadmin
            'superadmin' => $permissions,
            'jeffri' => $permissions,
            'maulana' => ['create services', 'edit services antrian', 'delete services antrian', 'move services antrian', 'edit services validasi'],
            'vivi' => ['create pinjams', 'edit pinjams', 'delete pinjams', 'move pinjams', 'edit stocks'],
            'sylvi' => ['create pinjams', 'edit pinjams', 'delete pinjams', 'move pinjams', 'create stocks', 'edit stocks', 'delete stocks',],
            'coni' => ['create pinjams', 'edit pinjams', 'delete pinjams', 'move pinjams', 'create stocks', 'edit stocks', 'delete stocks',],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleName => $permissionList) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($permissionList);
        }

        // Additional roles without specific permissions
        Role::create(['name' => 'teknisi']);
        Role::create(['name' => 'sales']);
        Role::create(['name' => 'david']);
    }

}
