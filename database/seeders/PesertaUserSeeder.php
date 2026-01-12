<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kursus;
use App\Models\Peserta;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PesertaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates 100 peserta users and randomly enrolls them in courses
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Indonesian locale for realistic names

        // Get all kursus IDs
        $kursusIds = Kursus::pluck('id')->toArray();

        if (empty($kursusIds)) {
            $this->command->error('No courses found. Please seed courses first.');
            return;
        }

        $this->command->info('Creating 100 peserta users with random enrollments...');
        $this->command->newLine();

        $totalEnrollments = 0;

        for ($i = 1; $i <= 100; $i++) {
            // Generate realistic Indonesian names
            $name = $faker->name();
            $email = $faker->unique()->safeEmail();

            // Create user with peserta role
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'peserta',
                'email_verified_at' => now(),
            ]);

            // Random number of courses to enroll (1-5 courses per student)
            $numCourses = rand(1, 5);

            // Get random course IDs for this student
            $enrolledCourses = collect($kursusIds)->shuffle()->take($numCourses);

            foreach ($enrolledCourses as $kursusId) {
                // Random status: mostly active, some completed
                $status = $faker->randomElement(['active', 'active', 'active', 'completed']);

                // Random enrollment date in the past 6 months
                $tanggalDaftar = $faker->dateTimeBetween('-6 months', 'now');

                // If completed, add completion date
                $tanggalSelesai = null;
                if ($status === 'completed') {
                    $tanggalSelesai = $faker->dateTimeBetween($tanggalDaftar, 'now');
                }

                // Create enrollment record
                Enrollment::create([
                    'user_id' => $user->id,
                    'kursus_id' => $kursusId,
                    'status' => $status,
                    'tanggal_daftar' => $tanggalDaftar,
                    'tanggal_selesai' => $tanggalSelesai,
                ]);

                // Also create peserta record for admin view
                Peserta::create([
                    'kursus_id' => $kursusId,
                    'nama_peserta' => $name,
                    'email' => $email,
                ]);

                $totalEnrollments++;
            }

            // Progress indicator
            if ($i % 10 === 0) {
                $this->command->info("Created {$i} users...");
            }
        }

        $this->command->newLine();
        $this->command->info("✅ Successfully created 100 peserta users!");
        $this->command->info("✅ Total enrollments created: {$totalEnrollments}");
        $this->command->newLine();
        $this->command->info("📧 All users can login with their email and password: 'password'");
    }
}
