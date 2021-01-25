<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Instantiate a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:1',
            'credit_card' => 'string|numeric|digits_between:10,24',
            'street' => 'string|max:128',
            'city' => 'string|max:128',
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_seller' => false,
        ]));

        $user->customer()->create([
            'credit_card' => $request->credit_card,
            'street' => $request->street,
            'city' => $request->city,
        ]);

        event(new Registered($user));
        Mail::to($request->email)->send(new NewUser($user));

        $user->customer()->create([]);
        return redirect(RouteServiceProvider::HOME);
    }
}
