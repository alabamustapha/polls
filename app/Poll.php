<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'description', 'status', 'button_one', 'button_two', 'answer', 'img'];
    public function votes()
    {
        return $this->hasMany('App\Vote');
    }


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    public function getButtonOneScoreAttribute(){
        return $this->votes()->where('vote', 1)->sum('vote_power');
    }
    
    public function getButtonTwoScoreAttribute(){
        return $this->votes()->where('vote', 2)->sum('vote_power');
    }
    
    public function getTotalScoreAttribute(){
        return $this->votes()->sum('vote_power');
    }
    
    public function getLossTotalScoreAttribute(){
        return $this->votes()->where('vote', '<>', $this->answer)->sum('vote_power');
    }
    
    public function getWinTotalScoreAttribute(){
        return $this->votes()->where('vote', $this->answer)->sum('vote_power');
    }
    
    public function getLossPercentageAttribute(){
        $loss_percentage = 0;

        if($this->total_score > 0){
            $loss_percentage = round(($this->loss_total_score / $this->total_score) * 100);
        }

        return  $loss_percentage;
    }
    
    public function getWinPercentageAttribute(){
        $win_percentage = 0;

        if ($this->total_score > 0) {
            $win_percentage = round(($this->win_total_score / $this->total_score) * 100);
        }

        return $win_percentage;
    }

    public function getButtonOnePercentageAttribute(){
        $button_one_percentage = 0;

        if ($this->total_score > 0) {
            $button_one_percentage = round(($this->button_one_score / $this->total_score) * 100);
        }

        return $button_one_percentage;
    }
    
    public function getButtonTwoPercentageAttribute(){

        $button_two_percentage = 0;
        
        if ($this->total_score > 0) {
            $button_two_percentage = round(($this->button_two_score / $this->total_score) * 100);
        }

        return $button_two_percentage;
        
    }
    
    


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    
}
