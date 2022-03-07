<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [ //des casts qu'on ne peut pas modif je crois
        'email_verified_at' => 'datetime',
    ];
    public function droituser()
    {
        return $this->hasOne(DroitUsers::class);
    }
    public function userelation(){
        return $this->belongsTo(DroitUsers::class, 'user_id');
    }

    public function isResp(){
        return $this->droituser->type_id == 3;
    }

    public function isOp(){
        return $this->droituser->type_id == 2;
    }

    public function isDemandeur(){
        return $this->droituser->type_id == 1;
    }
}
