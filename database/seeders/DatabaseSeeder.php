<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['admin', 'bendahara', 'pengurus', 'anggota'];

        foreach ($roles as $role) {
            User::factory()->create([
                'name' => ucfirst($role) . ' User',
                'email' => $role . '@monet.com',
                'role' => $role,
                'account_status' => 'approved',
                'password' => bcrypt('password'),
            ]);
        }
    }
}
