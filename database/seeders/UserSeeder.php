<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a superadmin user
        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('SuperiMin22!'),
        ]);

        // Assign the superadmin role
        $superadmin->assignRole('superadmin');

        // Create other users with their respective roles
        $users = [
            ['name' => 'Jeffri', 'email' => 'jeffri@example.com', 'password' => Hash::make('iMin2022'), 'role' => 'jeffri'],
            ['name' => 'Maulana', 'email' => 'maulana@example.com', 'password' => Hash::make('iMin2024'), 'role' => 'maulana'],
            ['name' => 'Vivi', 'email' => 'vivi@example.com', 'password' => Hash::make('iMin2021'), 'role' => 'vivi'],
            ['name' => 'Sylvi', 'email' => 'sylvi@example.com', 'password' => Hash::make('iMin2023'), 'role' => 'sylvi'],
            ['name' => 'Coni', 'email' => 'coni@example.com', 'password' => Hash::make('iMin2023'), 'role' => 'coni'],
            ['name' => 'Teknisi', 'email' => 'teknisi@example.com', 'password' => Hash::make('iMin2020'), 'role' => 'teknisi'],
            ['name' => 'Sales', 'email' => 'sales@example.com', 'password' => Hash::make('iMin2020'), 'role' => 'sales'],
            ['name' => 'David', 'email' => 'david@example.com', 'password' => Hash::make('iMin2020'), 'role' => 'david'],
        ];

        foreach ($users as $user) {
            // Create user
            $newUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            // Assign role to user
            $role = Role::where('name', $user['role'])->first();
            if ($role) {
                $newUser->assignRole($user['role']);
            }
        }
    }
}
