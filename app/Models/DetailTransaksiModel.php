<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransaksiModel extends Model
{
    use HasFactory;
    protected $table = 't_penjualan_detail';

    public $timestamps = false;

    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'detail_id',
        'penjualan_id',
        'barang_id',
        'harga',
        'jumlah',
    ];

    /**
     * Get the user that owns the TransaksiModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(TransaksiModel::class, 'penjualan_id', 'penjualan_id');
    }
    public function barang(): BelongsTo
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }
    
}
