<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'name', 'supplier_name', 'quantity', 'purchase_price', 'total_purchase_price', 'branch_id', 'owner'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function damages() 
    {
        return $this->hasMany(Damage::class);
    }
}
