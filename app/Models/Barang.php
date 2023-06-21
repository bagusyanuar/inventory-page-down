<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'jenis_barang_id',
        'bahan_id',
        'warna_id',
        'ukuran',
        'qty'
    ];

    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }

    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'bahan_id');
    }

    public function warna()
    {
        return $this->belongsTo(Warna::class, 'warna_id');
    }
}
