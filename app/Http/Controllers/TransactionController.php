<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $accounts = Account::where(
            'user_id',
            Auth::id()
        )->get();

        $transactions = Transaction::whereIn(
            'account_id',
            $accounts->pluck('id')
        )
        ->latest()
        ->get();

        return view(
            'transactions.index',
            compact('accounts', 'transactions')
        );
    }
}
