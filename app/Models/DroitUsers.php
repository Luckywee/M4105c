<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DroitUsers extends User
{
    use HasFactory;
    protected $fillable = [
        'user_id','type_id','competence'
    ];
}
