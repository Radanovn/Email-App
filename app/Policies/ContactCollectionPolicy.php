<?php

namespace App\Policies;

use App\ContactCollection;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactCollectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the document collection.
     *
     * @param  \App\User  $user
     * @param  \App\ContactCollection  $contactCollection
     * @return mixed
     */
    public function delete(User $user, ContactCollection $contactCollection)
    {
        // Every contact belongs to the authenticated user
        return $contactCollection->every(function ($contact) use ($user) {
            return $user->contacts->contains($contact);
        });
    }
}
