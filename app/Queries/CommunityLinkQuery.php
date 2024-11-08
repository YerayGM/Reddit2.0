<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinkQuery
{
    public function getByChannel(Channel $channel){
        return $channel->communityLinks()
            ->where('approved', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }

    public function getAll($perPage = 10){
        return CommunityLink::where('approved', true)
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage);
    }

    public function getMostPopular(){
        return CommunityLink::withCount('votes')
            ->where('approved', true)
            ->orderBy('votes_count', 'desc') // Ordena de más a menos votos
            ->paginate(10);
    }
    
    public function getMostPopularByChannel(Channel $channel){
        return $channel->communityLinks()
            ->withCount('votes')
            ->where('approved', true)
            ->orderBy('votes_count', 'desc') // Ordena de más a menos votos dentro del canal
            ->paginate(10);
    }
}
