<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Vote;
use App\User;

class AdminController extends Controller
{
    public function dashboard(){
        $total_users = User::all()->count();
        $total_polls = Poll::all()->count();
        $total_votes = Vote::all()->count();
        return view('admin.dashboard', compact(['total_users', 'total_polls', 'total_votes']));
    }

    public function showUsers(){
        $users = User::paginate(100);
        return view('users.index', compact('users'));
    }

    public function toggleUserStatus(Request $request, User $user)
    {
        $user->status = !$user->status;
        $user->save();
        $message = 'Status updated';
        return back()->with('message', $message);
    }
}
