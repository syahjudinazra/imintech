<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Services extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $fillable = [
        'serialnumber',
        'tanggalmasuk',
        'tanggalselesai',
        'pemilik',
        'status',
        'pelanggan',
        'servicesdevice_id',
        'pemakaian',
        'kerusakan',
        'perbaikan',
        'nosparepart',
        'snkanibal',
        'teknisi',
        'catatan',
    ];

    public function ServicesDevices(): BelongsTo
    {
        return $this->belongsTo(ServicesDevice::class);
    }
}
