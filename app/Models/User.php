<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'full_name',
        'email',
        'country_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function skill()
    {
        return $this->belongsToMany(skill::class);
    }
    public function country()
    {
        return $this->belongsTo(country::class);
    }
    public function level_user()
    {
        return $this->hasMany(skill_user::class);
    }

    public static function show_user(){
        return User::with(['country','skill','level_user'])->paginate(10);
    }
    public function hasAnyRoles(string $Role){
        return null !==$this->level_user()->where('level',$Role)->first();
    }

}
