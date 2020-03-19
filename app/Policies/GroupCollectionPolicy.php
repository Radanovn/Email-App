<?php

namespace App\Policies;

use App\GroupCollection;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupCollectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the document collection.
     *
     * @param  \App\User  $user
     * @param  \App\GroupCollection  $groupCollection
     * @return mixed
     */
    public function delete(User $user, GroupCollection $groupCollection)
    {
        // Every contact belongs to the authenticated user
        return $groupCollection->every(function ($group) use ($user) {
            return $user->groups->contains($group);
        });
    }
}
