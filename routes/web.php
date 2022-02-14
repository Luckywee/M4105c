<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TicketmainController;
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
    Route::get('/ticketmain', [TicketmainController::class, 'menu'])->name('ticketmain.view');
});
Route::get('/logout', [TicketmainController::class, 'logout'])->name('login.view');