<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public static $purchase;
    public static $purchaseItems;
    public static $message;
    protected $guarded = [];




    public function purchaseItems()
    {
        return $this->hasMany('App\Models\PurchaseItem');
    }
}
