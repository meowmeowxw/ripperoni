<?php

namespace App\Http\Controllers\Customer;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerSettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'auth',
            'customer'
        ]);
    }

    /**
     * Display the customer settings view
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customer = Auth::user()->customer;
        return view('customer.settings', ['customer' => $customer]);
    }

    /**
     * Handle an incoming settings edit request
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * TODO Credit card
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect(route('customer.settings'));
    }
}
