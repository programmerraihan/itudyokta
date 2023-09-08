<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $fillable = [
        "sale_id", "product_id", "unit_id", "unit_price", "quantity", "discount", "amount",
    ];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
