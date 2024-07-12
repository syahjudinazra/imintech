<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Firmwares extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'firmwares';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tipe',
        'versi',
        'android',
        'flash',
        'ota',
    ];
}
