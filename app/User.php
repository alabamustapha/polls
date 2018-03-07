<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'vote_power', 'account'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function votes(){
        return $this->hasMany('App\Vote');
    }
    
    public function getVotesWonAttribute(){
        $count = 0;
        foreach ($this->votes as $vote) {
            if($vote->vote == $vote->poll->answer){
                $count++;
            }
        }
        return $count;
    }
    public function getVotesLoseAttribute(){
        $count = 0;
        foreach ($this->votes as $vote) {
            if ($vote->vote != $vote->poll->answer) {
                $count++;
            }
        }
        return $count;
    }
    public function getIsAdminAttribute(){
        return $this->account == 'admin';
    }

    public function has_vote($poll){
        return in_array($poll->id, $this->votes()->pluck('poll_id')->toArray());
    }
    
    public function opinion($poll){
        if($poll->answer == null){
            return 'N/A';
        }
        return $this->votes()->where('poll_id', $poll->id)->first()->answer == 1 ? $poll->button_one : $poll->button_two;
        
    }
}
