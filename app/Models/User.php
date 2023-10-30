<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

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
    protected $casts = [
        'created_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public function notification()
    {
        $this->hasMany(Notification::class);
    }

    public function paiements()
    {
        $this->hasMany(Paiement::class);
    }

    public function userTo(){
        $this->belongsToMany(User::class, 'relationships', 
        'user_from_id', 'user_to_id', 'type');
    }

    public function userFrom(){
        $this->belongsToMany(User::class, 'relationships', 
        'user_from_id', 'user_to_id', 'type');
    }

    public function participations(){
        return $this->belongsToMany(Participation::class, 'vote', 'user_id', 'participation_id');
    }

    public function participations_action(){
        return $this->belongsToMany(Participation::class, 'action',
        'action_id', 'participation_id');
    }

    public function parametre(){
        $this->hasOne(Parameter::class);
    }

    public function post(){
        $this->belongsToMany(Post::class, 'interaction');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function participants(){
        return $this->hasOne(Participation::class);
    }

}  

