<?php


namespace App\Http\Controllers\Seller;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'auth',
            'not.seller'
        ]);
    }
    /**
     * Display the registration seller view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('seller.register');
    }


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        Auth::user()->is_seller = true;
        Auth::user()->save();
        Auth::user()->seller()->create([
            'company' => $request->company,
            'credit_card' => $request->credit_card,
        ]);
        return redirect(RouteServiceProvider::HOME);
    }
}
