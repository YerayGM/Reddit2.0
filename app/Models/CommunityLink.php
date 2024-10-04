<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importamos el modelo User

class CommunityLink extends Model
{
    use HasFactory;

    // Campos permitidos para asignación masiva
    protected $fillable = ['title', 'link', 'user_id', 'channel_id'];

    // Definimos la relación con el modelo User
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}



