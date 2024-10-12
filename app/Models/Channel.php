<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'color'];

    // Define la relación con CommunityLink
    public function communityLinks()
    {
        return $this->hasMany(CommunityLink::class); // Un canal puede tener muchos enlaces comunitarios
    }
}
