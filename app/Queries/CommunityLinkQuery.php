<?php
namespace App\Queries;

use App\Models\CommunityLink;
use App\Models\Channel;

class CommunityLinkQuery
{
    public function getByChannel(Channel $channel)
    {
        return CommunityLink::where('channel_id', $channel->id)
            ->where('approved', true);
    }

    public function getAll()
    {
        return CommunityLink::where('approved', true)
            ->orderBy('created_at', 'desc');
    }

    public function getMostPopular()
    {
        return CommunityLink::withCount('users') // Asegúrate de que 'users' es la relación correcta
            ->where('approved', true)
            ->orderBy('users_count', 'desc'); // Ordena por el conteo de votos
    }

    public function getMostPopularByChannel(Channel $channel)
    {
        return CommunityLink::withCount('users') // Asegúrate de que 'users' es la relación correcta
            ->where('channel_id', $channel->id)
            ->where('approved', true)
            ->orderBy('users_count', 'desc'); // Ordena por el conteo de votos
    }
}
