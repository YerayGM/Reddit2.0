<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function administrate(User $user)
    {
        return $user->admin == true;
    }
}
