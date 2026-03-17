<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'landlord_assignment',
        'agent_assignment',
        'branch',
        'property_type',
        'units_count',
        'location',
        'contact_phone',
        'contact_email',
        'description',
        'notes',
        'paybill_number',
        'account_format',
        'featured_image',
        'service_charge',
        'income_tax',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'service_charge' => 'decimal:2',
            'income_tax' => 'decimal:2',
        ];
    }
}
