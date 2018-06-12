<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MoneyValidationFormRequest;
use App\Models\Balance;
use App\User;

class BalanceController extends Controller
{
    private $totalPerPage = 5;

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

    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function depositStore(MoneyValidationFormRequest $request)
    {        
        $balance = auth()->user()->balance()->firstOrCreate([]);
        //dd($balance->deposit($request->value));

        $response = $balance->deposit($request->value);

        if($response['success'])
        {
            return redirect()->route('admin.balance')->with('success', $response['message']);
        }
        else
        {
            return back()->with('error', $response['message']);
        }

    }

    public function withdrawStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);

        if($response['success'])
        {
            return redirect()->route('admin.balance')->with('success', $response['message']);
        }
        else
        {
            return back()->with('error', $response['message']);
        }
    }

    public function transferStore(MoneyValidationFormRequest $request, User $user)
    {
        if(!$receiver = $user->find($request->receiver_id))
            return redirect()
                    ->route('balance.transfer')
                    ->with('error', 'Receiver user not found!');
    
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->value, $receiver);

        if($response['success'])
        {
            return redirect()->route('admin.balance')->with('success', $response['message']);
        }
        else
        {
            return back()->with('error', $response['message']);
        }
    }

    public function confirmTransfer(Request $request, User $user)
    {        
        if(!$receiver = $user->getReceiver($request->receiver))        
            return redirect()->back()->with('error','User to receive not found!');

        if($receiver->id === auth()->user()->id)
            return redirect()->back()->with('error','Sender and Receiver are the same!');

        $balance = '$' . number_format(auth()->user()->balance->amount, 2, ',', '');
        
        return view('admin.balance.transfer-confirm', compact('receiver', 'balance'));
        
    }

    public function historic()
    {
        $historics = auth()
            ->user()
            ->historics()
            ->with(['userTransaction'])
            ->paginate($this->totalPerPage);

        return view('admin.balance.historics', compact('historics'));
    }
}
