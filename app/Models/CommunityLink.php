<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Channel;
use App\Models\Vote; // Asegúrate de importar el modelo Vote
use Illuminate\Support\Facades\Auth;

class CommunityLink extends Model
{
    use HasFactory;

    // Campos permitidos para asignación masiva
    protected $fillable = ['title', 'link', 'channel_id'];

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

    // Definimos la relación con el modelo Vote
    public function votes()
    {
        return $this->hasMany(Vote::class); // Un CommunityLink puede tener muchos votos
    }

    public function hasAlreadyBeenSubmitted()
    {
        $existing = static::where('link', $this->link)->first();
        if ($existing) {
            if (Auth::user()->isTrusted()) {
                $existing->touch(); // Actualiza el timestamp
                if ($existing->approved == 0) {
                    $existing->approved = 1; // Aprueba el link si no está aprobado
                }
                $existing->save();
                session()->flash('success', 'The link already exists and its timestamp has been updated.');
                return true;
            } else {
                if ($existing->approved) {
                    session()->flash('warning', 'The link already exists and it is already approved but you are not a trusted user, so it will not be updated in the list.');
                } else {
                    session()->flash('warning', 'The link already exists and it is pending for approval but you are not a trusted user, so it will not be updated in the list.');
                }
                return true;
            }
        }
        return false;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_link_users');
    }
}