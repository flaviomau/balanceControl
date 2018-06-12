<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;

class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value) : Array
    {
        DB::beginTransaction();

        $before = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value, 2, '.', '');
        $deposit = $this->save();

        $historic = auth()->user()->historics()->create([
            'type'          => 'I', 
            'amount'        => $value, 
            'total_before'  => $before , 
            'total_after'   => $this->amount, 
            'date'          => date('Ymd')
        ]);

        if($deposit && $historic)
        {
            DB::commit();
            return [
                "success" => true,
                "message" => "Deposit done!"
            ];
        }
        else
        {
            DB::rollback();
            return [
                "success" => false,
                "message" => "Error doing deposit!"
            ];
        }
    }

    public function withdraw(float $value) : Array
    {
        if($value > $this->amount)
        {
            return [
                "success" => false,
                "message" => "Value higher than balance!"
            ];
        }

        DB::beginTransaction();

        $before = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $withdraw = $this->save();
        $historic = auth()->user()->historics()->create([
            'type'                  => 'O', 
            'amount'                => $value, 
            'total_before'          => $before , 
            'total_after'           => $this->amount,            
            'date'                  => date('Ymd')
        ]);

        if($withdraw && $historic)
        {
            DB::commit();
            return [
                "success" => true,
                "message" => "Withdraw done!"
            ];
        }
        else
        {
            DB::rollback();
            return [
                "success" => false,
                "message" => "Error doing withdraw!"
            ];
        }           
    }

    public function transfer(float $value, User $receiver) : Array
    {    
        if($value > $this->amount)
        {
            return [
                "success" => false,
                "message" => "Value higher than balance!"
            ];
        }

        DB::beginTransaction();

        $before = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $withdraw = $this->save();

        $historic = auth()->user()->historics()->create([
            'type'                  => 'T', 
            'amount'                => $value, 
            'total_before'          => $before , 
            'total_after'           => $this->amount, 
            'date'                  => date('Ymd'),
            'user_id_transaction'   => $receiver->id,
        ]);

        $receiverBalance = $receiver->balance()->firstOrCreate([]);
        $receiverBefore = $receiverBalance->amount ? $receiverBalance->amount : 0;
        $receiverBalance->amount += number_format($value, 2, '.', '');
        $receiverDeposit = $receiverBalance->save();
        $receiverHistoric = $receiver->historics()->create([
            'type'                  => 'I', 
            'amount'                => $value, 
            'total_before'          => $receiverBefore , 
            'total_after'           => $receiverBalance->amount,
            'date'                  => date('Ymd'),
            'user_id_transaction'   => auth()->user()->id
        ]);

        if($withdraw && $historic && $receiverDeposit && $receiverHistoric)
        {
            DB::commit();
            return [
                "success" => true,
                "message" => "Transfer done!"
            ];
        }
        else
        {
            DB::rollback();
            return [
                "success" => false,
                "message" => "Error doing transfer!"
            ];
        }
    }
}
