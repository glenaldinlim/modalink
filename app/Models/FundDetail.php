<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fund_id',
        'user_id',
        'payment_method_id',
        'unit',
        'purchase_status_id',
        'verification_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchaseStatus()
    {
        return $this->belongsTo(PurchaseStatus::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
