<?php

namespace App;

use App\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'stripe_id', 'stripe_key'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function files() {
        return $this->hasMany(File::class);
    }
    
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    
    public function isTheSameAs(User $user)
    {
        return $this->id === $user->id;
    }
    
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }
}
