<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        /*
        return view('hello', [
            'user' => User::findOrFail($id)
        ]);
        */
        $user = User::findOrFail($id);
        echo $request->session()->get('key', 'default').", ".$user->name.", ".$user->email.", ".$user->password;
    }
}
