<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Students_Current_Year extends Model {

    use Notifiable;
    
    public $table = "Students_Current_Year";
    
    protected $fillable = [
        'id',
    ];
}
