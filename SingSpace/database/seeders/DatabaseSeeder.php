<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Otomatis buat folder & copy foto ruangan ke Volume Railway
        if (!File::exists(storage_path('app/public/ruangan_photos'))) {
            File::makeDirectory(storage_path('app/public/ruangan_photos'), 0755, true);
        }
        File::copyDirectory(resource_path('seed_images/ruangan_photos'), storage_path('app/public/ruangan_photos'));

        // 2. Otomatis buat folder & copy foto profil ke Volume Railway
        if (!File::exists(storage_path('app/public/profile_photos'))) {
            File::makeDirectory(storage_path('app/public/profile_photos'), 0755, true);
        }
        File::copyDirectory(resource_path('seed_images/profile_photos'), storage_path('app/public/profile_photos'));

        // 3. Otomatis buat folder & copy bukti pembayaran ke Volume Railway
        if (!File::exists(storage_path('app/public/bukti_pembayaran'))) {
            File::makeDirectory(storage_path('app/public/bukti_pembayaran'), 0755, true);
        }
        File::copyDirectory(resource_path('seed_images/bukti_pembayaran'), storage_path('app/public/bukti_pembayaran'));

        // 3. Jalankan data seeder database kamu seperti biasa
        $this->call([
            UsersTableSeeder::class,
            FasilitasTableSeeder::class,
            RuangansTableSeeder::class,
            RuanganFasilitasTableSeeder::class,
            ReservasisTableSeeder::class,
        ]);
    }
}
