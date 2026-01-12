<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pengajar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PengajarUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengajars = [
            ['id' => 2, 'nama' => 'Sarah Johnson', 'email' => 'sarah.johnson@example.com'],
            ['id' => 3, 'nama' => 'Ahmad Hidayat', 'email' => 'ahmad.hidayat@example.com'],
            ['id' => 4, 'nama' => 'Lisa Martinez', 'email' => 'lisa.martinez@example.com'],
            ['id' => 5, 'nama' => 'Rudi Hermawan', 'email' => 'rudi.hermawan@example.com'],
            ['id' => 6, 'nama' => 'Maya Putri', 'email' => 'maya.putri@example.com'],
        ];

        foreach ($pengajars as $p) {
            // Check if user already exists
            $existingUser = User::where('email', $p['email'])->first();

            if (!$existingUser) {
                $user = User::create([
                    'name' => $p['nama'],
                    'email' => $p['email'],
                    'password' => Hash::make('password'),
                    'role' => 'pengajar',
                ]);

                Pengajar::where('id', $p['id'])->update(['user_id' => $user->id]);

                $this->command->info("Created user {$user->email} (id={$user->id}) -> pengajar_id={$p['id']}");
            } else {
                // Link existing user to pengajar
                Pengajar::where('id', $p['id'])->update(['user_id' => $existingUser->id]);
                $this->command->info("Linked existing user {$existingUser->email} -> pengajar_id={$p['id']}");
            }
        }
    }
}
