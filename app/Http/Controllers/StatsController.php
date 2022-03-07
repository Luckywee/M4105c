<?php

namespace App\Http\Controllers;

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

        $ticketsResolved = Ticket::where('etat_id',2)->get();
    return Inertia::render("stat",["tickets" => $tickets, "ticketsResolved"=> $ticketsResolved, "moi"=> $meinfo]);
    }
}
