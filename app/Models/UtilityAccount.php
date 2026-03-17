<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilityAccount extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'property_id',
        'provider',
        'account_number',
        'paybill_number',
        'status',
    ];
}
