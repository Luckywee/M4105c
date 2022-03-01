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

        //TABLE INSERT ETAT TICKET
        DB::table('etat_tickets')->delete();
        $etattable = [ 
            [
            "libelle_etat"=>"En attente" 
            ],
            [
            "libelle_etat"=>"Résolu" 
            ]
            ];
        DB::table('etat_tickets')->insert($etattable);



        //OBSOLETE
        /*//TABLE INSERT RESPONSABLE TYPE ID = 3
        DB::table('responsables')->delete();
        $responsabletable = [ 
            [
            "user_id"=>"1", //user id 1 = admin par exemple
            "type_id"=>"3" //type id 3 = responsable par exemple
            ],
            [
                "user_id"=>"3", //user id 1 = admin par exemple
                "type_id"=>"3" //type id 3 = responsable par exemple
            ]
            ];
        DB::table('responsables')->insert($responsabletable);


        //TABLE INSERT OPERATEUR TYPE ID = 2
        DB::table('operateurs')->delete();
        $operateurstable = [ 
            [
            "user_id"=>"4", //user id 1 = admin par exemple
            "type_id"=>"2", //type id 3 = responsable par exemple
            "competence_id"=>"1"
            ]
            ];
        DB::table('operateurs')->insert($operateurstable);

        //TABLE INSERT DEMANDEUR TYPE ID = 1
        DB::table('demandeurs')->delete();
        $demandeurstable = [ 
            [
            "user_id"=>"2", //user id 1 = admin par exemple
            "type_id"=>"1" //type id 3 = responsable par exemple
            ],
            [
                "user_id"=>"5", //user id 1 = admin par exemple
                "type_id"=>"1" //type id 3 = responsable par exemple
            ]
            ];
        DB::table('demandeurs')->insert($demandeurstable);*/
        /************************************************/
        //TABLE INSERT TYPE USERS
        DB::table('type_users')->delete();
            $typeuserstable = [ 
                [
                    "libelle"=>"Demandeur"
                    ],
                    [
                    "libelle"=>"Opérateur"
                    ], 
                    [
                    "libelle"=>"Responsable service"
                    ]
            ];
            DB::table('type_users')->insert($typeuserstable);

        //TABLE INSERT TYPE PROBLEME
        DB::table('type_problemes')->delete();

            $typeproblemetable = [ 
                [
                    "libelle"=>"Logiciel"
                    ],
                    [
                    "libelle"=>"Materiel"
                    ],
                    [
                    "libelle"=>"Utilisateur"
                    ]
            ];
            DB::table('type_problemes')->insert($typeproblemetable);

        //TABLE INSERT USERS
        DB::table('users')->delete();
            $userstable = [ 
            [
                "firstname"=>"admin",
                "lastname"=>"Admin",
                "email"=>"admin@gmail.com",
                "password"=>Hash::make("admin")
            ],
            [
                "firstname"=>"Dummy",
                "lastname"=>"John",
                "email"=>"john@gmail.com",
                "password"=>Hash::make("john")
            ],
            [
                "firstname"=>"Emre",
                "lastname"=>"Dilmac",
                "email"=>"emre.dilmac@etu.univ-smb.fr",
                "password"=>Hash::make("pett")
            ],
            [
                "firstname"=>"Jordan",
                "lastname"=>"Martinod",
                "email"=>"jordan.martinod@etu.univ-smb.fr",
                "password"=>Hash::make("aimbot")
            ],
            [
                "firstname"=>"Romain",
                "lastname"=>"Bongioanni",
                "email"=>"romain.bongioanni@etu-univ.smb.fr",
                "password"=>Hash::make("minecraft")
            ]
            ];
            DB::table('users')->insert($userstable);
            
            //insert les droits des utilisateurs
            DB::table('droit_users')->delete();

            $droitusers = [ 
                [
                    "user_id"=>"1",
                    "type_id"=>"3"
                    ],
                [
                    "user_id"=>"2",
                    "type_id"=>"1"
                    ],
                [
                    "user_id"=>"3",
                    "type_id"=>"1"
                    ],
                [
                    "user_id"=>"4",
                    "type_id"=>"2",
                    //"competence"=>"1"
                    ],
                [
                    "user_id"=>"5",
                    "type_id"=>"3"
                    ],
            ];
            DB::table('droit_users')->insert($droitusers);

        //TABLE INSERT UN TICKET EXEMPLE
        $date = date('Y-m-d');
        //DB::table('tickets')->delete();
        $ticketinsert = [
        [
        "datecreation"=> $date,
        "type_probleme_id"=>"3",
        'droituser_id'=>"2",
        "description"=>"Jordan a bloqué l'accès à mon drive oof",
        //'operateur_id'
        //'responsable_id'
        //'piecejointe'
        "etat_id"=>"1", 
        ],
        [
        "datecreation"=> $date,
        "type_probleme_id"=>"1",
        'droituser_id'=>"2",
        "description"=>"William a piraté mes bitcoins :(((((((",
        //'operateur_id'
        //'responsable_id'
        //'piecejointe' 
        "etat_id"=>"1" 
        ],
        [
        "datecreation"=> $date,
        "type_probleme_id"=>"2",
        'droituser_id'=>"3",
        "description"=>"MON PC A CRASH MDR",
        //'operateur_id'
        //'responsable_id'
        //'piecejointe' 
        "etat_id"=>"1" 
        ],
        [
        "datecreation"=> $date,
        "type_probleme_id"=>"1",
        'droituser_id'=>"2",
        "description"=>"Jordan a installé un aimbot ",
        //'operateur_id'
        //'responsable_id'
        //'piecejointe' 
        "etat_id"=>"1" 
        ]
        ];
        
        DB::table('tickets')->insert($ticketinsert);

    }
}
