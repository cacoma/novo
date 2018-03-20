<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class stock extends Model
{
    //
      use Notifiable;

  protected $fillable = [
        'symbol', 'type',
    ];
   protected $hidden = [
        'id',
    ];
}
