<?php

namespace App\Http\Controllers;
use App\Models\Transaction;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function monthlySummary()
    {
        $transactions = Transaction::where('status', 'approved')
            ->whereMonth('created_at', now()->month)
            ->get();

        return response()->json($transactions);
    }
}
