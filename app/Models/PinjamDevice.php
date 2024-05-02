<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PinjamDevice extends Model
{
    use HasFactory;

    protected $table = 'pinjamsdevice';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function PinjamPilar(): HasMany
    {
        return $this->hasMany(Pinjam::class);
    }
}
