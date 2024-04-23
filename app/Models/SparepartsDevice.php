<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SparepartsDevice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sparepartsdevice';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function spareparts()
    {
        return $this->hasOne(Spareparts::class);
    }

}
