<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function requisition()
    {
        return $this->belongsTo('App\Models\Requisition', 'requisition_id');
    }
}
