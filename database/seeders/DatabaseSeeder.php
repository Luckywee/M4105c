<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*User::create([
            "firstname"=>"admin",
            "lastname"=>"admin",
            "email"=>"admin@gmail.com",
            "password"=>Hash::make("admin")
        ]);*/

        //TABLE INSERT RESPONSABLE
        /*DB::table('responsables')->insert([
            "user_id"=>"1", //user id 1 = admin par exemple
            "type_id"=>"3" //type id 3 = responsable par exemple
        ]);*/

        //TABLE INSERT OPERATEUR
        /*DB::table('operateurs')->insert([
            "user_id"=>"3", //user id 1 = admin par exemple
            "type_id"=>"2", //type id 2 = operateur par exemple
            "competence_id"=>"2"

        ]);*/

        //TABLE INSERT DEMANDEUR
        /*DB::table('demandeurs')->insert([
            "user_id"=>"2", //user id 1 = admin par exemple
            "type_id"=>"1", //type id 2 = operateur par exemple
        ]);*/

        //TABLE INSERT TYPE USERS
        /*DB::table('type_users')->insert([
            "libelle"=>"Responsable service"
        ]);*/

        //TABLE INSERT TYPE PROBLEME
        /*DB::table('type_problemes')->insert([
            "libelle"=>"Utilisateur"
        ]);*/

        //TABLE INSERT USERS
        /*DB::table('users')->insert([
            "firstname"=>"Dummy",
            "lastname"=>"John",
            "email"=>"john@gmail.com",
            "password"=>Hash::make("john")
        ]);*/

        //TABLE INSERT UN TICKET EXEMPLE
        $date = date('Y-m-d');
        /*DB::table('tickets')->insert([
        "datecreation"=> $date,
        "type_probleme_id"=>"3",
        'demandeur_id'=>"2",
        "description"=>"Jordan a bloqué l'accès à mon drive oof",
        //'operateur_id'
        //'responsable_id'
        //'piecejointe' 
        ]);*/

    }
}
