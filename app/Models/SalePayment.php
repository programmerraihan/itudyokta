<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        "date", "reference_no", "branch_id", "customer", "phone", "quantity", "amount", "discount_amount", "sale_id","paid_amount", "grand_total", "note",
    ];

    public function sale() {
        return $this->belongsTo(Sale::class);
    }
}
