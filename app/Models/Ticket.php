<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    public function typeprobleme(){
        return $this->belongsTo(TypeProbleme::class, 'type_probleme_id');
    }
    public function typeetat(){
        return $this->belongsTo(EtatEticket::class, 'etat_id');
    }

    protected $fillable = [
        'description', 'commentaire','etat_id','libelle_etat','piecejointe','type_probleme_id','droituser_id','datecreation'
    ];
}
