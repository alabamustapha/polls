<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Events\UserVoteForPoll;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $polls = Poll::whereStatus(1)->get();
        return view('home', compact('polls'));
    }


    public function poll(Poll $poll){
        return view('poll', compact('poll'));
    }

    public function showUpdatePasswordForm(){
        return view('users.update_password');
    }

    public function updatePassword(Request $request, User $user)
    {
        
        Validator::make(
            $request->all(),
            [
                'old_password' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]
        )->validate();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('above-navbar-message', 'Password Updated');
        }

        return back()->with('above-navbar-message', 'Something went wrong');
    }

    public function voteHistory(){
        $votes = auth()->user()->votes()->get();
        return view('users.history', compact('votes'));
    }
}
