<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_detail';

    protected $fillable = [
        'barang_keluar_id',
        'barang_id',
        'qty'
    ];

    public function barang_keluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'barang_keluar');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
