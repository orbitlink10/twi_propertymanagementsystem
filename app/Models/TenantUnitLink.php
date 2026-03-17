<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantUnitLink extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'property_id',
        'tenant_name',
        'unit_number',
        'status',
    ];
}
