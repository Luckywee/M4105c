<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function displayLogin()
    {
        return Inertia::render("login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => [
                "required",
                "email"
            ],
            "password" => [
                "required"
            ]
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('ticketmain'); //pour forcer à quitter la page de login je crois
        }
        
        return back()->withErrors([
            'email' => 'L\'email n\'existe pas.',
            'password' => 'Le mot de passe n\'est pas bon.'
        ]);
    }
    public function messages()
    {
        return [
            'email.required' => 'Un email est requis',
            'password.required' => 'Un mot de passe est requis',
        ];
    }
}
