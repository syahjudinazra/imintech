<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stocks extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'stocks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'serialnumber',
        'stocksdevice_id',
        'noinvoice',
        'tanggalmasuk',
        'tanggalkeluar',
        'pelanggan',
        'lokasi',
        'keterangan',
        'status',
    ];

    public function StocksTipe(): BelongsTo
    {
        return $this->belongsTo(StocksDevice::class, 'stocksdevice_id');
    }
}
