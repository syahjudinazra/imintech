<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServicesDevice extends Model
{
    use HasFactory;

    protected $table = 'servicesdevice';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function ServicesPilar(): HasMany
    {
        return $this->hasMany(Services::class);
    }
}
