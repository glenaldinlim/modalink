<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'merchant_id',
        'fund_type_id',
        'name',
        'description',
        'tenor',
        'interest_rate',
        'fund_target',
        'deadline',
        'price_per_unit',
        'fund_status_id',
    ];
}
