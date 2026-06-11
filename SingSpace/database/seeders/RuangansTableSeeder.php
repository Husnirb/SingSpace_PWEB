<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RuangansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ruangans')->delete();
        
        \DB::table('ruangans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kode_ruangan' => 'REG-01',
                'nama' => 'Regular Room 1',
                'deskripsi' => 'Ruangan Regular dengan kenyamanan maksimal dan speaker full bass',
                'tipe' => 'Regular',
                'harga' => '25000.00',
                'kapasitas' => 4,
                'is_aktif' => 1,
                'foto' => 'ruangan_photos/gnzaFVtRzmF4Uk1ZU5MFcDAII9FYtVmLt3AB0xP1.jpg',
                'created_at' => '2026-05-19 13:52:43',
                'updated_at' => '2026-05-19 13:52:43',
                'user_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'kode_ruangan' => 'FAM-01',
                'nama' => 'Family Room 1',
                'deskripsi' => 'Ruangan karaoke terbaik yang cocok untuk bersama keluarga atau orang banyak',
                'tipe' => 'Family',
                'harga' => '100000.00',
                'kapasitas' => 10,
                'is_aktif' => 1,
                'foto' => 'ruangan_photos/cPGF8d5dWdwJYGwPlxn0nvQBMXMb0FmaHKZenM44.jpg',
                'created_at' => '2026-05-19 13:56:28',
                'updated_at' => '2026-05-19 13:56:28',
                'user_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'kode_ruangan' => 'VIP-01',
                'nama' => 'VIP Room 2',
                'deskripsi' => 'ruangan vip terbaik dengan fasilitas maksimal',
                'tipe' => 'VIP',
                'harga' => '50000.00',
                'kapasitas' => 4,
                'is_aktif' => 0,
                'foto' => 'ruangan_photos/6U6340Ab7B4uUMCqQe9XXRCHY4xT9FxQzdBLIOsm.jpg',
                'created_at' => '2026-05-19 13:57:24',
                'updated_at' => '2026-06-10 07:10:24',
                'user_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'kode_ruangan' => 'VIP-03',
                'nama' => 'VIP Room 3',
                'deskripsi' => 'VIP Room',
                'tipe' => 'VIP',
                'harga' => '50000.00',
                'kapasitas' => 4,
                'is_aktif' => 0,
                'foto' => 'ruangan_photos/evoC5yK8P78DtCSz2INHfDjLPxE0pUobONKnVBcs.jpg',
                'created_at' => '2026-06-10 08:54:17',
                'updated_at' => '2026-06-10 10:14:36',
                'user_id' => 1,
            ),
        ));
        
        
    }
}