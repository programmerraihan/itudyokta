<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsProvider extends Model
{
    use HasFactory;

    protected $table = 'sms_providers';

    protected $fillable = [
        'name', 'provider_url', 'sms_check_url', 'active', 'extra', 'branch_id',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
