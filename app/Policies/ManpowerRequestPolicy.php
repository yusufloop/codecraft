<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ManpowerRequest;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManpowerRequestPolicy
{

    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole(['HR', 'Department Head']);
    }

    // Determine whether the user can view the manpower request
    public function view(User $user, ManpowerRequest $manpowerRequest)
    {
        return $user->hasRole('HR') || $user->id === $manpowerRequest->requested_by;
    }

    // Determine whether the user can create manpower requests
    public function create(User $user)
    {
        return $user->hasRole('Department Head');
    }

    // Determine whether the user can update the manpower request
    public function update(User $user, ManpowerRequest $manpowerRequest)
    {
        return $user->hasRole('Department Head') && $user->id === $manpowerRequest->requested_by && $manpowerRequest->status === 'Pending';
    }

    // Determine whether the user can delete the manpower request
    public function delete(User $user, ManpowerRequest $manpowerRequest)
    {
        return $user->hasRole('Department Head') && $user->id === $manpowerRequest->requested_by && $manpowerRequest->status === 'Pending';
    }

    // Determine whether the user can approve the manpower request
    public function approve(User $user, ManpowerRequest $manpowerRequest)
    {
        return $user->hasRole('HR') && $manpowerRequest->status === 'Pending';
    }
}
