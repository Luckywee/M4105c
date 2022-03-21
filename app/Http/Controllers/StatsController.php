<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use App\Models\Operateur;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StatsController extends Controller
{
    public function printStats(){
        $meinfo = Auth::user();
        $tickets = Ticket::all();
        $users = User::all();
        $operateurs = [];
        $demandeurs = [];
        foreach (User::all() as $usr) {
            if($usr->isOp()){
                $operateurs[] = $usr;
            }
            else if($usr->isDemandeur()){
                $demandeurs[] = $usr;
            }
        }

        $ticketsResolved = Ticket::where('etat_id',2)->get();
    return Inertia::render("stat",["tickets" => $tickets, "users"=>$users, "operateurs"=>$operateurs, "demandeurs"=>$demandeurs, "ticketsResolved"=> $ticketsResolved, "moi"=> $meinfo]);
    }
}
