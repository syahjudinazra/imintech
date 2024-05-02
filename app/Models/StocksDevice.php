<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StocksDevice extends Model
{
    use HasFactory;

    protected $table = 'stocksdevice';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function StocksPilar(): HasMany
    {
        return $this->hasMany(Stocks::class);
    }
}
