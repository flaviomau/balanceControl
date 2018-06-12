<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MoneyValidationFormRequest;
use App\Models\Balance;

class BalanceController extends Controller
{
    public function index()
    {
        //dd(auth()->user()->name);
        //dd(auth()->user()->name());
        $balance = auth()->user()->balance;
        $amount  = $balance ? $balance->amount : 0;
        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        return view('admin.balance.deposit');
    }

    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }

    public function depositStore(MoneyValidationFormRequest $request)
    {        
        $balance = auth()->user()->balance()->firstOrCreate([]);
        //dd($balance->deposit($request->deposit_value));

        $response = $balance->deposit($request->deposit_value);

        if($response['success'])
        {
            return redirect()->route('admin.balance')->with('success', $response['message']);
        }
        else
        {
            return back()->with('error', $response['message']);
        }

    }

}
