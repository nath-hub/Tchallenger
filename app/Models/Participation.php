<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Participation extends Model
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];



    public function post()
    {
        return $this->belongsTo(Post::class, "post_id");
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'vote', 'user_id', 'participation_id');
    }

    public function user_action()
    {
        return $this->belongsToMany(User::class, 'action',   'action_id', 'participation_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function media(){
        return $this->hasOne(Media::class);
    }
}
