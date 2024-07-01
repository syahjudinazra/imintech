<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Spareparts extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'spareparts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nosparepart',
        'tipe',
        'nama',
        'quantity',
        'harga',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'nosparepart',
                'tipe',
                'nama',
                'quantity',
                'harga',
            ])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "You have {$eventName} data");
    }
}
