<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vote extends Pivot
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

   
    public function user(){
        $this->belongsToMany(User::class, 'action_challenges', 'challenge_id'
    ,'user_id', 'comments', 'type', 'ip_adress', 'canal');
    }
}
