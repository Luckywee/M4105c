<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\DroitUsers;
use App\Models\EtatTicket;
use App\Models\User;
use App\Models\TypeProbleme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AffecterTicketController extends Controller
{
    public function displayaffecterticket(int $id){
        $meinfo = Auth::user();
        $operateurs = DB::table('droit_users')->leftjoin('type_problemes','competence','=','type_problemes.id')->join('users', 'user_id', '=', 'users.id')->select('droit_users.id','droit_users.competence','type_problemes.libelle','users.*')->where('type_id', 2)->get();
        //var_dump($operateurs);
        if(User::find(Auth::user()->id)->isResp() || User::find(Auth::user()->id)->isOp()){ //securite pour pas que d'autres role accéde à la page affectation du ticket
            return Inertia::Render("affecterticket", ["operateurs" => $operateurs, "moi" => $meinfo, "ticket" => Ticket::find($id)]);
        } else {
            return redirect()->intended('ticketmain');
        }
    }

    public function affectationnow(Request $req, int $id){
        $operateur = DB::table('droit_users')->leftjoin('type_problemes','competence','=','type_problemes.id')->join('users', 'user_id', '=', 'users.id')->select('droit_users.id','droit_users.competence','type_problemes.libelle','users.*')->where('type_id', 2)->get();
        $check = $req->validate([
            "operateur_id" => ['required']
        ]);
        Ticket::find($id)->update($check);
        return Inertia::Render("ticketEstAffecte", ["ticket" => Ticket::find($id) , "moi" => Auth::user(), "operateur" => $operateur]);
    }
}
