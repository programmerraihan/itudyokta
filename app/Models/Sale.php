<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        "date", "reference_no", "branch_id", "customer", "phone", "quantity", "amount", "discount_amount",  "paid_amount", "due_amount", "grand_total", "note",
    ];

    public function saleItems() {
        return $this->hasMany(SaleItem::class);
    }

    public function salePayment() {
        return $this->hasMany(SalePayment::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function branch() 
    {
        return $this->belongsTo(Branch::class);
    }
}
