<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Historic extends Model
{
    protected $fillable = ['type', 'amount', 'total_before', 'total_after', 'user_id_transaction', 'date'];

    public function type($type = null)
    {
        $types = [
            'I' => 'Deposit',
            'O' => 'Withdraw',
            'T' => 'Transfer to',
        ];

        if(!$type)
            return $type;

        if($this->user_id_transaction != null && $type == 'I')
            return "Received from";        

        return $types[$type];
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y/m/d');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userTransaction()
    {
        return $this->belongsTo(User::class, 'user_id_transaction');
    }
}
