<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'ikon'];

    public function ruangans()
    {
        return $this->belongsToMany(Ruangan::class, 'ruangan_fasilitas');
    }
}
