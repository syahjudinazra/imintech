<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spareparts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'spareparts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nospareparts',
        'sparepartsdevice_id',
        'nama',
        'quantity',
        'harga',
    ];

    public function SparepartsDevice(): BelongsTo
    {
        return $this->belongsTo(SparepartsDevice::class);
    }
}
