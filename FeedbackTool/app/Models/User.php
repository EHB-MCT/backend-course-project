<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'caretaker_id',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function survey() {
        return $this->hasMany(Survey::class);
    }

    public function survlists() {
        return $this->hasMany(Survlist::class, 'user_id', 'id');
    }

    public function session() {
        if (!Auth::user()->can('moderate')){
            if (Auth::user()->can('caretaker') && !Auth::user()->can('moderate')){
                return $this->hasMany(Session::class, 'caretaker_id');
            } else {
                return $this->hasMany(Session::class, 'client_id');
            }
        }
    }
}
