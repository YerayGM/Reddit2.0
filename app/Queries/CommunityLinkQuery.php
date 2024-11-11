<?php
namespace App\Queries;

use App\Models\CommunityLink;
use App\Models\Channel;

class CommunityLinkQuery
{
    public function getByChannel(Channel $channel)
    {
        return CommunityLink::where('channel_id', $channel->id)
            ->where('approved', true)
            ->paginate(10);
    }

    public function getAll()
    {
        return CommunityLink::where('approved', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getMostPopular()
    {
        // Aquí puedes definir una lógica alternativa para determinar la "popularidad"
        return CommunityLink::where('approved', true)
            ->orderBy('created_at', 'desc') // O cualquier otra lógica que necesites
            ->paginate(10);
    }

    public function getMostPopularByChannel(Channel $channel)
    {
        // Aquí también puedes definir una lógica alternativa para determinar la "popularidad"
        return CommunityLink::where('channel_id', $channel->id)
            ->where('approved', true)
            ->orderBy('created_at', 'desc') // O cualquier otra lógica que necesites
            ->paginate(10);
    }
}