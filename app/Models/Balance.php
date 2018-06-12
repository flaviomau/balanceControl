<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value) : Array
    {
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
            return [
                "success" => true,
                "message" => "Saldo atualizado com sucesso!"
            ];
        }

        return [
            "success" => false,
            "message" => "Erro ao atualizar o saldo!"
        ];
    }
}
