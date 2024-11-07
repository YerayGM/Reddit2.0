<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['community_link_id', 'user_id'];

    public function communityLink()
    {
        return $this->belongsTo(CommunityLink::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}