<?php

namespace App\Http\Controllers;

use App\Http\Middleware\isResp;
use App\Models\Ticket;
use App\Models\Demandeur;
use App\Models\DroitUsers;
use App\Models\EtatTicket;
use App\Models\User;
use App\Models\TypeProbleme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TicketController extends Controller
{
    public function menu()
    {
        $idUser = Auth::user()->id;
        $meinfo = Auth::user();
        $resp = User::find(Auth::user()->id)->isResp();
        $op = User::find(Auth::user()->id)->isOp();
        //dd($meinfo);
        if($resp){ //si utilisateur est responsable
        $tickets = DB::table('tickets')->join('type_problemes', 'type_probleme_id', '=', 'type_problemes.id')
            ->join('droit_users', 'droituser_id', '=', 'droit_users.id')
            ->join('users', 'user_id', '=', 'users.id')->select('tickets.*', 'type_problemes.libelle', 'users.firstname', 'users.lastname')->OrderBy('datecreation', 'desc')->OrderBy('id', 'desc')->get();
        }
        else if ($op){
            $tickets = DB::table('tickets')->join('type_problemes', 'type_probleme_id', '=', 'type_problemes.id')
                ->join('droit_users', 'droituser_id', '=', 'droit_users.id')
                ->join('users', 'user_id', '=', 'users.id')->select('tickets.*', 'type_problemes.libelle', 'users.firstname', 'users.lastname','users.id AS usrid')->where('tickets.operateur_id',$idUser)->OrderBy('tickets.datecreation', 'desc')->OrderBy('tickets.id', 'desc',)->get();
        }
        else{ 
            $tickets = DB::table('tickets')->join('type_problemes', 'type_probleme_id', '=', 'type_problemes.id')
            ->join('droit_users', 'droituser_id', '=', 'droit_users.id')
            ->join('users', 'user_id', '=', 'users.id')->select('tickets.*', 'type_problemes.libelle', 'users.firstname', 'users.lastname','users.id AS userid')->where('tickets.droituser_id',$idUser)->OrderBy('tickets.datecreation', 'desc')->OrderBy('tickets.id', 'desc',)->get(); //si deux table.id faire un AS qqch comme ça la vueJS ne confond pas des IDs.
        }
        //$tickets = Ticket::OrderBy('datecreation', 'desc')->get();
        //var_dump($tickets);  
        return Inertia::render("ticketmain", ["tickets" => $tickets, "moi" => $meinfo, "resp" => $resp, "dem" => User::find(Auth::user()->id)->isDemandeur()]); //dire à Inertia VueJS que tickets et égale au tickets de laravel
    }
    
    public function oneticket(int $id){ //le ID pris en compte dans la route par paramètre
        $meinfo = Auth::user();
        $roleop = User::find(Auth::user()->id)->isOp();
        $roleresp = User::find(Auth::user()->id)->isResp();

        $tickets = DB::table('tickets')->join('type_problemes', 'type_probleme_id', '=', 'type_problemes.id')->join('etat_tickets', 'etat_id', '=', 'etat_tickets.id')
        ->join('droit_users', 'droituser_id', '=', 'droit_users.id')
        ->join('users', 'user_id', '=', 'users.id')->select('tickets.*', 'type_problemes.libelle', 'users.firstname', 'users.lastname', 'etat_tickets.libelle_etat')->where('tickets.id', $id)->get(); //ON PEUT AVEC DES Ticket:: with->

        $listeprobleme = DB::table('type_problemes')->select('type_problemes.libelle')->get();
        $listeetat = DB::table('etat_tickets')->select('etat_tickets.id', 'etat_tickets.libelle_etat')->get(); //dans le get pour pouvoir afficher la liste des etats et ensuite les edits après le post (il ne faut rien oublié dans les parametre)
        //var_dump($listeproblemeetat);
    return Inertia::render("ticketmodification",["tickets" => $tickets /*Ticket::find($id)*/,"listeprobleme" => $listeprobleme, "listeetat"=> $listeetat, "ticket" => Ticket::findOrFail($id), "roleop" => $roleop, "roleresp" => $roleresp, "moi" => $meinfo]); //ticket = pour override les valeurs des datas dans ticketmodification.vue
    }

    //MODIF D'UN TICKET
    public function updateticket(Request $request, int $id){
        $meinfo = Auth::user();
        EtatTicket::find($request->etat_id);

        $validor = $request->validate([ //on check s'il y a des valeurs qui a été modifié ou sinon si pas de valeurs alors on ne peut pas submit (aussi, c'est de la recup des données du form du template vueJS)
            "description" => ['required'],"commentaire" => [], "etat_id" => [], "libelle_etat" => [] //faut pas que ça soit vide
        ]);
            Ticket::FindOrFail($id)->update($validor); //on update via la variable validor qui est le request validate
            return Inertia::Render("ticketupdate", ["tickets" => Ticket::find($id), "moi" => $meinfo]);

    }
    public function displayupdate(int $id){
        $meinfo = Auth::user();
        $see = DB::table('tickets')->join('etat_tickets', 'etat_id', '=', 'etat_tickets.id')->select('tickets.*', 'etat_tickets.libelle_etat')->where('tickets.id', $id)->get();
        //$listeetat = EtatTicket::all();
        return Inertia::render("ticketupdate", ["tickets" => Ticket::find($id), "ticketarray" => $see, "moi" => $meinfo]);
    }

    public function displaymakenewticket(){
        $meinfo = Auth::user();
        $tickets = DB::table('tickets')->join('type_problemes', 'type_probleme_id', '=', 'type_problemes.id')->join('etat_tickets', 'etat_id', '=', 'etat_tickets.id')
        ->join('droit_users', 'droituser_id', '=', 'droit_users.id')
        ->join('users', 'user_id', '=', 'users.id')->select('tickets.*', 'type_problemes.libelle', 'users.firstname', 'users.lastname', 'etat_tickets.libelle_etat')->get();
        $userid = Auth::user()->id;
        $yo = DroitUsers::find($userid);
        //$user = Auth::user()->userelation()->$testi;
        //var_dump($yo->user_id);
        $listeprobleme = TypeProbleme::all(); //DB::table('type_problemes')->select('type_problemes.id', 'type_problemes.libelle')->get();
        return Inertia::render("ticketform", ["listeprobleme" => $listeprobleme, "tickets" => $tickets, "moi" => $meinfo]);
    }

    public function displayinsert(){
        $meinfo = Auth::user();
        return Inertia::Render("ticketenvoye", ["tickets" => Ticket::all(), "moi" => $meinfo]);
    }

    //INSERER UN TICKET
    public function insererticket(Request $request){
        //CHECK DANS FORM
        $request->validate([
            "description" => ['required'], "type_probleme_id" => ['required'], "piecejointe" => []
        ]);
        
        //VARIABLES
        $date = date('Y-m-d');
        $userid = Auth::user()->id;
        $testi = DroitUsers::find($userid);
        $typeProbleme = TypeProbleme::find($request->type_probleme_id);
        $image_path = '';
        //$name = null;
        //

        //UPLOAD FICHIER IMAGE
        if ($request->hasFile('piecejointe')) {
            //$image_path = $request->file('piecejointe')->store('img', 'public');
            $name = rand(0,100) . '-' . $request->piecejointe->getClientOriginalName();
            $image_path = $request->file('piecejointe')->move(public_path('img/upload'),$name);
        } else {
            $name = null;
        }
        //INSERT TIME
        $ticket = Ticket::create([
            "datecreation"=> $date,
            "description"=> $request->description, //$request->description prend dans le template vue un v-model="form.description" et aussi celle du data()
            "droituser_id"=>$testi->user_id,
            //'operateur_id'
            //'responsable_id'
            'piecejointe'=>$name,//$request->piecejointe, 
            "etat_id"=>"1",
            "type_probleme_id" => $request->type_probleme_id
        ]);
        //$name = $request->piecejointe->getClientOriginalName();
       // $request->piecejointe->move('public/img/',$name);
        //$ticket->typeprobleme()->save($typeProbleme);
        return Inertia::Render("ticketenvoye", ["tickets" => Ticket::all()]);
    }

}
