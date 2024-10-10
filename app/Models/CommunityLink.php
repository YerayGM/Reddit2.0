<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importamos el modelo User
use App\Models\Channel; // Importamos el modelo Channel

class CommunityLink extends Model
{
    use HasFactory;

    // Campos permitidos para asignación masiva
    protected $fillable = ['title', 'link', 'channel_id', 'user_id'];

    // Definimos la relación con el modelo User
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Definimos la relación con el modelo Channel
    public function channel()
    {
        return $this->belongsTo(Channel::class); // Un CommunityLink pertenece a un Channel
    }
}
