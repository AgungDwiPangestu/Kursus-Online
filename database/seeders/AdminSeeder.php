<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Create pengajar user example
        User::updateOrCreate(
            ['email' => 'pengajar@example.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'pengajar',
                'email_verified_at' => now(),
            ]
        );

        // Create peserta user example
        User::updateOrCreate(
            ['email' => 'peserta@example.com'],
            [
                'name' => 'Ani Wijaya',
                'password' => Hash::make('password'),
                'role' => 'peserta',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('Admin: admin@example.com / password');
        $this->command->info('Pengajar: pengajar@example.com / password');
        $this->command->info('Peserta: peserta@example.com / password');
    }
}
