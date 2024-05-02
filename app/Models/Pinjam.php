<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pinjam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pinjams';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal',
        'gambar',
        'serialnumber',
        'pinjamsdevice_id',
        'ram',
        'android',
        'pelanggan',
        'alamat',
        'sales',
        'no_telp',
        'pengirim',
        'kelengkapankirim',
        'tanggalkembali',
        'penerima',
        'kelengkapankembali',
        'status',
    ];


    public function PinjamTipe(): BelongsTo
    {
        return $this->belongsTo(PinjamDevice::class, 'pinjamsdevice_id');
    }
}
