<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'since',
        'business_type_id',
        'business_category_id',
        'siup_path',
        'nib_path',
        'skdp_tdp_path',
        'deed_company_path',
        'status_id',
        'verification_status_id',
    ];
}
