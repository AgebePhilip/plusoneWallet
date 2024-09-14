<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Wallet;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transfer(Request $request)
    {
        $request->validate([
            'sender_wallet_id' => 'required|exists:wallets,id',
            'receiver_wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric',
        ]);

        $senderWallet = Wallet::find($request->sender_wallet_id);
        $receiverWallet = Wallet::find($request->receiver_wallet_id);

        if ($request->amount > 1000000) {
            return response()->json(['message' => 'Transfer pending approval'], 403);
        }

        $senderWallet->balance -= $request->amount;
        $receiverWallet->balance += $request->amount;

        $senderWallet->save();
        $receiverWallet->save();

        return response()->json(['message' => 'Transfer successful']);
    }

    public function approveTransfer(Request $request, Transaction $transaction)
    {
        if (auth()->user()->isAdmin()) {
            $transaction->status = 'approved';
            $transaction->save();
            return response()->json(['message' => 'Transfer approved']);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}

