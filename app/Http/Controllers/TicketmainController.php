<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Demandeur;
use App\Models\User;
use App\Models\TypeProbleme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TicketmainController extends Controller{
    public function menu(){
        $username = Auth::user()->firstname;
        $lastname = Auth::user()->lastname;
        $tickets = DB::table('tickets')->join('type_problemes','type_probleme_id', '=' , 'type_problemes.id')
        ->join('demandeurs','demandeur_id', '=' , 'demandeurs.id')
        ->join('users','user_id', '=' , 'users.id')->select('tickets.*' , 'type_problemes.libelle', 'users.firstname', 'users.lastname')->OrderBy('datecreation', 'desc')->get();
        //$tickets = Ticket::OrderBy('datecreation', 'desc')->get();
        //var_dump($tickets);  
        return Inertia::render("ticketmain", [ "tickets" => $tickets], ["username" => $username], ["lastname" => $lastname]); //dire à Inertia VueJS que tickets et égale au tickets de laravel
    }

    public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}