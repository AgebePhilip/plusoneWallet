<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function createWallet(Request $request)
    {
        $request->validate([
            'currency' => 'required|unique:wallets',
        ]);

        $wallet = Wallet::create([
            'user_id' => auth()->id(),
            'currency' => $request->currency,
        ]);

        return response()->json($wallet);
    }

    public function creditWallet(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric',
        ]);

        $wallet = Wallet::find($request->wallet_id);
        $wallet->balance += $request->amount;
        $wallet->save();

        return response()->json($wallet);
    }
}


