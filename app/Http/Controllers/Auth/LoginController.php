<?php

namespace App\Http\Controllers\Auth;
use App\Models\Demandeur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\User;

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
            if(User::find(Auth::user()->id)->isDemandeur()){
                return redirect()->intended('ticketform');
            }
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
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
