<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDet extends Model
{
    use HasFactory;

    protected $table = 'transaksi_det';
    protected $primaryKey = 'id';

    protected $fillable = [
        'transaksi_id',
        'nama_pembeli',
        'total_harga',
        'harga_diskon'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    public function transaksi_det_menu()
    {
        return $this->hasMany(TransaksiDetMenu::class, 'transaksi_det_id', 'id');
    }
}
