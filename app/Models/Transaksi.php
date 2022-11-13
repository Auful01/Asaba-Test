<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'total_harga',
        'harga_diskon',
        'diskon',
        'max_diskon',
        'min_pembelian',
        'ongkir',
    ];
    /**
     * Get all of the transaksi_det f Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaksi_det()
    {
        return $this->hasMany(TransaksiDet::class, 'transaksi_id', 'id');
    }
}
