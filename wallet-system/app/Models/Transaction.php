<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['sender_wallet_id', 'receiver_wallet_id', 'amount', 'status'];

    /**
     * Define the relationship with the sender's Wallet model.
     * A Transaction belongs to a sender Wallet.
     */
    public function senderWallet()
    {
        return $this->belongsTo(Wallet::class, 'sender_wallet_id');
    }

    /**
     * Define the relationship with the receiver's Wallet model.
     * A Transaction belongs to a receiver Wallet.
     */
    public function receiverWallet()
    {
        return $this->belongsTo(Wallet::class, 'receiver_wallet_id');
    }
}
