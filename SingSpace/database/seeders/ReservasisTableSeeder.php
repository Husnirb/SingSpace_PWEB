<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReservasisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('reservasis')->delete();
        
        \DB::table('reservasis')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'ruangan_id' => 3,
                'tanggal' => '2026-05-20',
                'jam_mulai' => '14:00:00',
                'jam_selesai' => '15:00:00',
                'durasi' => 1,
                'total_harga' => 50000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/gYXZcBcqjaqsUqWrVwD2jZDPzgAIn5409pWUfAoE.jpg',
                'status' => 'confirmed',
                'created_at' => '2026-05-19 14:44:17',
                'updated_at' => '2026-06-09 06:27:36',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'ruangan_id' => 2,
                'tanggal' => '2026-05-28',
                'jam_mulai' => '17:00:00',
                'jam_selesai' => '18:00:00',
                'durasi' => 1,
                'total_harga' => 100000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/ub7AfQNkVnxi6ECx9WWpIyPC91oQM07yPkTLpYCh.jpg',
                'status' => 'confirmed',
                'created_at' => '2026-05-20 05:15:52',
                'updated_at' => '2026-06-09 06:27:40',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 2,
                'ruangan_id' => 2,
                'tanggal' => '2026-05-21',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '20:00:00',
                'durasi' => 1,
                'total_harga' => 100000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/8M3swmbLgc54Ytst01FSdLPqUGlYmAQuaaG7GLYS.jpg',
                'status' => 'confirmed',
                'created_at' => '2026-05-20 06:35:00',
                'updated_at' => '2026-05-20 09:46:02',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 2,
                'ruangan_id' => 2,
                'tanggal' => '2026-05-22',
                'jam_mulai' => '17:00:00',
                'jam_selesai' => '18:00:00',
                'durasi' => 1,
                'total_harga' => 100000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/H8arxytK8tlbYzsaiSMgTQcVbxkpLxpbTrCGMEak.jpg',
                'status' => 'confirmed',
                'created_at' => '2026-05-20 12:59:21',
                'updated_at' => '2026-06-09 06:27:38',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 2,
                'ruangan_id' => 2,
                'tanggal' => '2026-06-13',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '11:00:00',
                'durasi' => 1,
                'total_harga' => 100000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/XD5Z1ZnwxAWsxUpxmnSO4KkkDKldseQ2YQhrZMxW.png',
                'status' => 'batal',
                'created_at' => '2026-06-10 06:42:33',
                'updated_at' => '2026-06-10 07:03:14',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 2,
                'ruangan_id' => 2,
                'tanggal' => '2026-06-13',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '11:00:00',
                'durasi' => 1,
                'total_harga' => 100000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/nCYTGuq6Ue5VeVmhVAe0iINAjCz7xWxJyyadRGyO.png',
                'status' => 'confirmed',
                'created_at' => '2026-06-10 07:04:01',
                'updated_at' => '2026-06-10 07:05:24',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 2,
                'ruangan_id' => 3,
                'tanggal' => '2026-06-23',
                'jam_mulai' => '21:00:00',
                'jam_selesai' => '22:00:00',
                'durasi' => 1,
                'total_harga' => 50000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/0JaW3D3s1IjadZPIyhMYj593tnJNxw5tPS35kIy2.png',
                'status' => 'confirmed',
                'created_at' => '2026-06-10 07:11:52',
                'updated_at' => '2026-06-10 07:16:34',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 2,
                'ruangan_id' => 1,
                'tanggal' => '2026-06-10',
                'jam_mulai' => '12:00:00',
                'jam_selesai' => '13:00:00',
                'durasi' => 1,
                'total_harga' => 25000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/OSDN1dwrrJhdKWmi7Yyx2LuW5JpklDlK4SMjjvlC.png',
                'status' => 'confirmed',
                'created_at' => '2026-06-10 07:52:01',
                'updated_at' => '2026-06-10 08:17:57',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 2,
                'ruangan_id' => 1,
                'tanggal' => '2026-06-10',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'durasi' => 4,
                'total_harga' => 100000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/tHBXxR1QVVQXjIsiLLqCIFP7IbxrkvD9SGNMKeLH.png',
                'status' => 'confirmed',
                'created_at' => '2026-06-10 08:17:42',
                'updated_at' => '2026-06-10 08:17:56',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 2,
                'ruangan_id' => 1,
                'tanggal' => '2026-06-10',
                'jam_mulai' => '17:00:00',
                'jam_selesai' => '22:00:00',
                'durasi' => 5,
                'total_harga' => 125000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/VxTCKiMOIcxdGm1fKJ4cJRtLiQMyc8C6fOv1OKs5.png',
                'status' => 'confirmed',
                'created_at' => '2026-06-10 08:21:41',
                'updated_at' => '2026-06-10 08:22:06',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 2,
                'ruangan_id' => 3,
                'tanggal' => '2026-06-10',
                'jam_mulai' => '16:00:00',
                'jam_selesai' => '17:00:00',
                'durasi' => 1,
                'total_harga' => 50000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/JuMju4TWiBgbkqeltvcF9j3p9BFKxH4hyI7ivCZ2.png',
                'status' => 'pending',
                'created_at' => '2026-06-10 08:30:08',
                'updated_at' => '2026-06-10 08:30:08',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 2,
                'ruangan_id' => 3,
                'tanggal' => '2026-06-10',
                'jam_mulai' => '17:00:00',
                'jam_selesai' => '18:00:00',
                'durasi' => 1,
                'total_harga' => 50000,
                'metode_pembayaran' => 'Transfer Mandiri',
                'bukti_pembayaran' => 'bukti_pembayaran/wMCejddbGoqObw7RtB6kFNikGlDSg7bBJlercgfw.png',
                'status' => 'pending',
                'created_at' => '2026-06-10 08:33:45',
                'updated_at' => '2026-06-10 08:33:45',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 2,
                'ruangan_id' => 3,
                'tanggal' => '2026-06-10',
                'jam_mulai' => '18:00:00',
                'jam_selesai' => '19:00:00',
                'durasi' => 1,
                'total_harga' => 50000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/FiKuimuNWcLwReJEXPuGmJ1EVaiM6RWVP6XB2n05.png',
                'status' => 'pending',
                'created_at' => '2026-06-10 08:35:19',
                'updated_at' => '2026-06-10 08:35:19',
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 2,
                'ruangan_id' => 3,
                'tanggal' => '2026-06-10',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '20:00:00',
                'durasi' => 1,
                'total_harga' => 50000,
                'metode_pembayaran' => 'QRIS',
                'bukti_pembayaran' => 'bukti_pembayaran/o9izQJxCf1XNtHOTaTBbFYoD6EhSD0ONJOqUKZQV.png',
                'status' => 'pending',
                'created_at' => '2026-06-10 08:40:35',
                'updated_at' => '2026-06-10 08:40:35',
            ),
        ));
        
        
    }
}