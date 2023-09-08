<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static $requisition;
    public static $message;


    public function requisitionDetail()
    {
        return $this->hasMany(RequisitionDetail::class, 'requisition_id', 'id');
    }
}
