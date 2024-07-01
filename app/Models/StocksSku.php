<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class StocksSku extends Model
{
    use HasFactory;

    protected $table = 'stocks_sku';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function StocksUnit(): HasMany
    {
        return $this->hasMany(Stocks::class);
    }
}
