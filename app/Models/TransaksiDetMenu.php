<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetMenu extends Model
{
    use HasFactory;

    protected $table = 'transaksi_det_menu';

    protected $fillable = [
        'transaksi_det_id',
        'nama_menu',
        'harga',
        'jumlah',
    ];

    public function transaksi_det()
    {
        return $this->belongsTo(TransaksiDet::class, 'transaksi_det_id', 'id');
    }
}
