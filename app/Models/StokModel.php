<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokModel extends Model
{
    use HasFactory;

    protected $table = 't_stok';

    public $timestamps = false;

    protected $primaryKey = 'stok_id';

    protected $fillable = [
        'stok_id',
        'barang_id',
        'user_id',
        'stok_jumlah',
        'stok_tanggal'
    ];

   /**
    * Get the user that owns the StokModel
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
   }
   public function barang(): BelongsTo
   {
       return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
   }

}
