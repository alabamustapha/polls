<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['vote_power', 'user_id', 'poll_id', 'vote'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function poll()
    {
        return $this->belongsTo('App\Poll');
    }
}
