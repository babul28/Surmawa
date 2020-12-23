<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        Auth::login($user = Lecture::create(
            array_merge(
                $this->validationRequest($request),
                [
                    'password' => Hash::make($request->password),
                ]
            )
        ));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Handle validation request
     *
     * @param Request $request
     * @return array
     */
    private function validationRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'university' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
        ]);
    }
}
