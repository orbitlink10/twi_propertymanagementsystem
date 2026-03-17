<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'location',
        'status',
    ];
}
