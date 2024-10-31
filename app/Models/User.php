<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // Debe estar descomentado
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',  // Este es el tipo correcto para las contraseñas
    ];

    // app/Models/User.php

    public function communityLinks()
    {
        return $this->hasMany(CommunityLink::class);
    }

    // app/Models/User.php
    public function isTrusted()
    {
        return $this->trusted;
    }

    // app/Models/User.php
    public function votes()
    {
        // Relación muchos a muchos con CommunityLink a través de la tabla pivote community_link_users
        return $this->belongsToMany(CommunityLink::class, 'community_link_users');
    }

    public function votedFor(CommunityLink $link)
    {
        // Verifica si el enlace ya está en la colección de votos del usuario
        return $this->votes->contains($link);
    }
}
