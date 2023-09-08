<?php

namespace App\Models;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    

    public function Purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function Supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }


    public function Unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function Product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
