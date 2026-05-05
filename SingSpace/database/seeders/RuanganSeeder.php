<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_ruangan' => 'REG-01',
                'nama' => 'Regular Room 1',
                'deskripsi' => 'Ruang standar dengan sistem audio berkualitas.',
                'tipe' => 'Regular',
                'harga' => 50000,
                'kapasitas' => 4,
                'is_aktif' => true,
            ],
            [
                'kode_ruangan' => 'REG-02',
                'nama' => 'Regular Room 2',
                'deskripsi' => 'Nyaman untuk bernyanyi bersama teman dekat.',
                'tipe' => 'Regular',
                'harga' => 50000,
                'kapasitas' => 4,
                'is_aktif' => true,
            ],
            [
                'kode_ruangan' => 'FAM-01',
                'nama' => 'Family Room 1',
                'deskripsi' => 'Ruang luas untuk keluarga kecil.',
                'tipe' => 'Family',
                'harga' => 80000,
                'kapasitas' => 8,
                'is_aktif' => true,
            ],
            [
                'kode_ruangan' => 'VIP-01',
                'nama' => 'VIP Room 1',
                'deskripsi' => 'Fasilitas premium dengan sofa mewah.',
                'tipe' => 'VIP',
                'harga' => 120000,
                'kapasitas' => 12,
                'is_aktif' => true,
            ],
            [
                'kode_ruangan' => 'VVIP-01',
                'nama' => 'Royal VVIP',
                'deskripsi' => 'Pengalaman karaoke terbaik dengan pantry pribadi.',
                'tipe' => 'VVIP',
                'harga' => 200000,
                'kapasitas' => 20,
                'is_aktif' => true,
            ],
            [
                'kode_ruangan' => 'VIP-02',
                'nama' => 'VIP Room 2 (Maintenance)',
                'deskripsi' => 'Sedang dalam perbaikan audio.',
                'tipe' => 'VIP',
                'harga' => 120000,
                'kapasitas' => 12,
                'is_aktif' => false, // Sengaja false untuk tes scope nanti
            ],
        ];

        foreach ($data as $item) {
            Ruangan::create($item);
        }
    }
}
