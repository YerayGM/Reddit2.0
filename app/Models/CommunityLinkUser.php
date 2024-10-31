<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLinkUser extends Model
{
    use HasFactory;

    // Habilitar la asignación masiva para estos campos
    protected $fillable = ['user_id', 'community_link_id'];

    // Método toggle para alternar entre votar y retirar el voto
    public function toggle()
    {
        if ($this->exists) {
            $this->delete(); // Si el voto existe, eliminarlo
        } else {
            $this->save(); // Si no existe, guardarlo como nuevo voto
        }
    }
}
