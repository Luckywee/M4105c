<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {

    return Inertia::render("index",[
        "list" => [
            "Element 1",
            "Element 2"
        ]
    ]);
})->name("index");*/

Route::get('/bonjour', function() {
    return Inertia::render("bonjour");
})->name("bonjour");


//LOGIN
Route::get('/', [LoginController::class, 'displayLogin'])->name('login.view');
Route::post('/', [LoginController::class, 'login'])->name('login');

Route::get('/login', [LoginController::class, 'displayLogin'])->name('login.view');
Route::post('/login', [LoginController::class, 'login'])->name('login');
/************************************/
Route::middleware("auth")->group(function(){
    Route::get('/ticketmain', [TicketController::class, 'menu'])->name('ticketmain.view');
    //Route::get("ticketmodification/{id}",[TicketController::class,"menumodif"])->name("ticketmodification");
    //Route::post("ticketmodification/{id}",[TicketController::class,"menumodif"])->name("ticketmodification");
    Route::get("ticketmodification/{id}",[TicketController::class,"oneticket"])->name("oneticket");
    Route::post("ticketmodification/{id}",[TicketController::class,"oneticket"])->name("oneticket");

    Route::get("update/{id}",[TicketController::class,"displayupdate"])->name("ticketupdate.view");
    Route::post("update/{id}",[TicketController::class,"updateticket"])->name("updateticket");

    //formulaire pour la création d'un nouveau ticket
    Route::get("ticketform",[TicketController::class,"displaymakenewticket"])->name("displaymakenewticket");
    //INSERER TICKET
    Route::get("ticketinset",[TicketController::class,"displayinsert"])->name("ticketenvoye.view");  
    Route::post("ticketinset",[TicketController::class,"insererticket"])->name("insererticket");

    //Route::get("/ticketform",[TicketController::class,"store"])->name("store");  
    //Route::post("/img",[TicketController::class,"store"])->name("store");
    //Route::post('image', [TicketController::class,'store'])->name('image.store');
    Route::get("ticketenvoye",[TicketController::class,"displayinsert"])->name("displayinsert");

    Route::get("affecterticket/{id}",[TicketController::class,"displayaffecterticket"])->name("affecterticket");
    Route::post("affecterticket/{id}",[TicketController::class,"seeOperateurUniquement"])->name("seeOperateurUniquement");
    
});
Route::get('/logout', [LoginController::class, 'logout'])->name('login.view');