<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransaksiModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan';

    public $timestamps = false;

    protected $primaryKey = 'penjualan_id';

    protected $fillable = [
        'penjualan_id',
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal'
    ];

    /**
     * Get the user that owns the TransaksiModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    public function detailTransaksi(): HasMany
    {
        return $this->hasMany(DetailTransaksiModel::class, 'detail_id', 'detail_id');
    }
}
