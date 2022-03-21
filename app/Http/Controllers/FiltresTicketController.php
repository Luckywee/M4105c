<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\TypeProbleme;

class FiltresTicketController extends Controller
{
    public function filtrertype(Request $r){
        $lefiltre = $r->idprobleme;
        $nouveauticket = DB::table('tickets')->join('type_problemes', 'type_probleme_id', '=', 'type_problemes.id')->join('etat_tickets', 'etat_id' ,'=', 'etat_tickets.id')
        ->join('droit_users', 'droituser_id', '=', 'droit_users.id')
        ->join('users', 'user_id', '=', 'users.id')->select('tickets.*', 'type_problemes.libelle', 'users.firstname', 'users.lastname', 'etat_tickets.libelle_etat')->OrderBy('datecreation', 'desc')->OrderBy('id', 'desc')->where('type_problemes.libelle',$lefiltre)->get();
        //dd($lefiltre);
        return Inertia::render("ticketmain",["tickets" => $nouveauticket, "probleme" => TypeProbleme::all()]);
        //return redirect()->back();
    }
}
