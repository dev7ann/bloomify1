<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function moods()
    {
        return $this->hasMany(Mood::class);
    }

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    public function wellnessTips()
    {
        return $this->hasMany(WellnessTip::class, 'created_by');
    }
}