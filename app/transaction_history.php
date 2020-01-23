<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class transaction_history extends Model {

    use Notifiable;

    protected $fillable = [
        'id', 'amount', 'fundingAgancy',
    ];

}
