<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'ruangan_id', 'tanggal', 'jam_mulai', 'jam_selesai',
        'durasi', 'total_harga', 'metode_pembayaran', 'bukti_pembayaran', 'status',
    ];

    // Relasi: Reservasi ini milik siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Reservasi ini untuk ruangan mana?
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
