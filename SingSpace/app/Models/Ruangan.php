<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_ruangan',
        'nama',
        'deskripsi',
        'tipe',
        'harga',
        'kapasitas',
        'is_aktif',
        'foto'
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
        'harga' => 'decimal:2',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    public function fasilitas()
    {
    return $this->belongsToMany(Fasilitas::class, 'ruangan_fasilitas');
    }
}
