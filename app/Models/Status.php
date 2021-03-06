<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public function merchants()
    {
        return $this->hasMany(Merchant::class);
    }

    public function userCredential()
    {
        return $this->hasMany(UserCredential::class);
    }
}
