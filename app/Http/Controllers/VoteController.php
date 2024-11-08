<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function store(Request $request, $communityLinkId)
    {
        $communityLink = CommunityLink::findOrFail($communityLinkId);

        // Verificar si el usuario ya ha votado
        if (Vote::where('community_link_id', $communityLink->id)
            ->where('user_id', Auth::id())
            ->exists()
        ) {
            return response()->json(['message' => 'Ya has votado por este enlace.'], 400);
        }

        // Crear un nuevo voto
        $vote = new Vote();
        $vote->community_link_id = $communityLink->id;
        $vote->user_id = Auth::id();
        $vote->save();

        return response()->json(['message' => 'Voto registrado con éxito.'], 201);
    }

    public function destroy($communityLinkId)
    {
        $vote = Vote::where('community_link_id', $communityLinkId)
            ->where('user_id', Auth::id())
            ->first();

        if ($vote) {
            $vote->delete();
            return response()->json(['message' => 'Voto eliminado con éxito.'], 200);
        }

        return response()->json(['message' => 'No se encontró el voto.'], 404);
    }
}
