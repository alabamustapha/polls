<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::firstOrCreate([]);
        return view('admin.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();
        if ($request->has('new_user_activation') && $request->new_user_activation == 'on') {
            $setting->new_user_activation = true;

        } else {
            $setting->new_user_activation = false;
        }

        $setting->max_vote_power = $request->max_vote_power;

        $setting->save();

        return back()->with('message', 'Setting updated');
    }
}
