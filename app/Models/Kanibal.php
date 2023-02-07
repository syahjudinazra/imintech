<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Kanibal extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'tanggal',
        'serialnumber',
        'pelanggan',
        'model',
        'ram',
        'android',
        'kerusakan',
        'kerusakanbawaan',
        'teknisi',
        'perbaikan',
        'snkanibal',
        'nosparepart',
        'note',
    ];

    public $sortable = ['id', 'tanggal', 'serialnumber', 'pelanggan', 'model'];
}
