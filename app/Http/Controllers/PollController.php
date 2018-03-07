<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;
use App\Http\Requests\StorePollRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ClosePollRequest;
use App\Setting;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::with('votes')->paginate(100);
        return view('polls.index', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('polls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePollRequest $request)
    {
        $poll = Poll::create($request->all());
        $poll->img = $request->img->store('images', 'public');
        $poll->save();
        
        return back()->with('message', 'Poll created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        return view('polls.show', compact('poll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        return view('polls.edit', compact('poll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {

        
        $poll->update($request->except('img'));
        
        if($request->hasFile('img')){
           
            $polls_count = Poll::where('img', $poll->img)->where('id', '<>', $poll->id)->count();
            $img = $request->img->store('images', 'public');
           
            if(!$polls_count){


                if (Storage::disk('public')->exists($poll->img)) {
                    Storage::disk('public')->delete($poll->img);
                }
                
            }

            $poll->img = $img;
            $poll->save();
        }

        return back()->with('message', $poll->name . ' updated');
    }
   
    /**
     * Update poll status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function closePoll(ClosePollRequest $request, Poll $poll)
    {
        $setting = Setting::first();
        
            $poll->status = 0;
            $poll_votes = $poll->votes;

            foreach ($poll_votes as $vote) {
                
                if ($vote->vote == $poll->answer) {
                     $vote->user->vote_power = ($vote->user->vote_power < $setting->max_vote_power) ? ++$vote->user->vote_power : $setting->max_vote_power;
                } else {
                $vote->user->vote_power = ($vote->user->vote_power > 1) ? --$vote->user->vote_power : 1;
                }
                $vote->user->save();

            }
        
        $poll->save();
      
        return back()->withMessage("Vote closed successully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        if (Storage::exists('storage/' . $poll->img)) {
            Storage::delete('storage' . $poll->img);
        }
        $poll->delete();
        return back()->with('message', 'poll deleted successfully');
    }


}
