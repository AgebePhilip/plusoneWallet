<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'currency', 'balance'];

    /**
     * Define the relationship with the User model.
     * A Wallet belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
