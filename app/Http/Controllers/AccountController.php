<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
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
    public function deposit(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:1|max:1000000'
        ]);

        $account = Account::findOrFail(
            $request->account_id
        );

        if ($account->balance < $request->amount) {

            return back()->with(
                'error',
                'Fondos insuficientes'
            );
        }

        $account->balance -= $request->amount;

        $account->save();

        Transaction::create([
            'account_id' => $account->id,
            'type' => 'deposit',
            'amount' => $request->amount,
            'balance_after' => $account->balance
        ]);

        return back()->with(
            'success',
            'Transferencia realizada'
        );
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:1'
        ]);

        $account = Account::findOrFail(
            $request->account_id
        );

        if (($account->balance + $request->amount) > 9999999999.99) {

            return back()->with(
                'error',
                'El saldo excede el límite permitido'
            );
        }

        $account->balance += $request->amount;

        $account->save();

        Transaction::create([
            'account_id' => $account->id,
            'type' => 'withdraw',
            'amount' => $request->amount,
            'balance_after' => $account->balance
        ]);

        return back()->with(
            'success',
            'Dinero recibido'
        );
    }
}
