<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredential extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'job',
        'birthdate',
        'username',
        'idcard',
        'idcard_path',
        'npwp',
        'npwp_path',
        'status_id',
        'verification_status_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function verificationStatus()
    {
        return $this->belongsTo(VerificationStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
