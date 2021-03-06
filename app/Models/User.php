<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'gender',
        'phone',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function getRoleNameAttribute()
    {
        return ucfirst($this->getRoleNames()[0]);
    }

    public function getJoinYearAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('M Y');
    }

    public function merchants()
    {
        return $this->hasMany(Merchant::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function userCredential()
    {
        return $this->hasOne(userCredential::class);
    }

    public function userBankAccount()
    {
        return $this->hasOne(UserBankAccount::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function fundDetails()
    {
        return $this->hasMany(FundDetail::class);
    }
}
