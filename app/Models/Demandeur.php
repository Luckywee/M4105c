<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandeur extends User
{
    use HasFactory;
    
    protected $fillable = [
        'type_id','user_id'
    ];

    /*public function userelationdemandeur(){
        return $this->belongsTo(User::class, 'user_id');
    }*/

}
