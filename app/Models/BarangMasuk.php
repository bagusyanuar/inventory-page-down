<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'supplier_id',
        'tanggal',
        'no_masuk',
        'keterangan'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function detail()
    {
        return $this->hasMany(BarangMasukDetail::class, 'barang_masuk_id');
    }

    public function getSumQtyAttribute()
    {
        $details = $this->detail()->get();
        return $details->sum('qty');
    }
}
