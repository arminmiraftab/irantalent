<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skill_user extends Model
{
    use HasFactory;
    protected $table = 'skill_user';
    public $timestamps = false;

    protected $fillable = [
        'skill_id',
        'user_id',
        'level',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function skill()
    {
        return $this->belongsTo(skill::class);
    }
}
