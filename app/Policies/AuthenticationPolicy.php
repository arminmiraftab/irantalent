<?php

namespace App\Policies;

use App\Models\skill_user;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthenticationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function basic (skill_user $user) {
        return $user->hasAnyRoles('basic');
    }
     public function intermediate (skill_user $user) {
         return $user->hasAnyRoles('intermediate');
    }
     public function advance (skill_user $user) {
         return $user->hasAnyRoles('intermediate');
    }

}
