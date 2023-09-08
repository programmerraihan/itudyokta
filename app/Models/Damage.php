<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    use HasFactory;

    protected $fillable = [
       "date", "asset_id", "quantity", "damage_price", "total_damage_price", "owner", "branch_id",
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
