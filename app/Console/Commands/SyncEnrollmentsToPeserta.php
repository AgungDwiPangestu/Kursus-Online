<?php

namespace App\Console\Commands;

use App\Models\Enrollment;
use App\Models\Peserta;
use Illuminate\Console\Command;

class SyncEnrollmentsToPeserta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:enrollments-to-peserta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all enrollments data to peserta table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Syncing enrollments to peserta table...');

        $enrollments = Enrollment::with(['user', 'kursus'])->get();
        $synced = 0;
        $skipped = 0;

        foreach ($enrollments as $enrollment) {
            // Check if user and kursus exist
            if (!$enrollment->user || !$enrollment->kursus) {
                $skipped++;
                continue;
            }

            // Check if already exists in peserta table
            $exists = Peserta::where('email', $enrollment->user->email)
                ->where('kursus_id', $enrollment->kursus_id)
                ->exists();

            if (!$exists) {
                Peserta::create([
                    'kursus_id' => $enrollment->kursus_id,
                    'nama_peserta' => $enrollment->user->name,
                    'email' => $enrollment->user->email,
                ]);
                $synced++;
                $this->line("  ✓ Synced: {$enrollment->user->name} -> {$enrollment->kursus->nama_kursus}");
            } else {
                $skipped++;
            }
        }

        $this->info("Sync complete! Synced: {$synced}, Skipped (already exists): {$skipped}");

        return Command::SUCCESS;
    }
}
