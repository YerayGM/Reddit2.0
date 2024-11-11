<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLinkUser  extends Model
{
    protected $fillable = ['user_id', 'community_link_id'];

    public function votes()
    {
        return $this->belongsToMany(CommunityLink::class, 'community_link_users');
    }

    public function votedFor(CommunityLink $link)
    {
        return $this->votes->contains($link);
    }

    public function toggle()
    {
        if ($this->exists) {
            $this->delete();
        } else {
            $this->save();
        }
    }
}
