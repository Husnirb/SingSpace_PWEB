<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        session()->flash('success', 'Selamat datang kembali, Husni!');
        $daftarRuangan = [
            ['nama' => 'Regular Room', 'kapasitas' => '4 Orang', 'harga' => 'Rp 50.000/jam'],
            ['nama' => 'Family Room', 'kapasitas' => '8 Orang', 'harga' => 'Rp 80.000/jam'],
            ['nama' => 'VIP Room', 'kapasitas' => '12 Orang', 'harga' => 'Rp 120.000/jam'],
            ['nama' => 'VVIP Room', 'kapasitas' => '20 Orang', 'harga' => 'Rp 200.000/jam'],
        ];
        return view('dashboard', compact('daftarRuangan'));
    }
}
