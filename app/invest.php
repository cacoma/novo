<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class invest extends Model
{
    //
  public function user()
    {
        return $this->belongsTo(User::Class,'user_id','id');
    }
}
