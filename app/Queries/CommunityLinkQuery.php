<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinkQuery
{
    public function getByChannel(Channel $channel)
    {
        return $channel->communityLinks()
            ->where('approved', true)
            ->latest('updated_at')
            ->paginate(10);
    }

    public function getAll()
    {
        return CommunityLink::where('approved', true)
            ->latest('updated_at')
            ->paginate(10);
    }

    public function getMostPopular()
    {
        return CommunityLink::where('approved', true)
            ->latest('updated_at')
            ->paginate(10);
    }

    public function getMostPopularByChannel(Channel $channel)
    {
        return $channel->communityLinks()
            ->where('approved', true)
            ->orderBy('updated_at', 'desc') // Ordena por la fecha de actualización como alternativa
            ->paginate(10);
    }
}
