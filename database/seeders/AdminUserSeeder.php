<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's admin account.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'reisenseo@gmail.com'],
            [
                'name' => 'System Admin',
                'password' => 'rooney@10',
            ]
        );
    }
}
