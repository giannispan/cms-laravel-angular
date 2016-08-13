<?php

namespace App\Policies;

use App\User;
use App\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    public function destroy(User $user, Subject $subject)
    {
        return $user->id === $page->user_id;
    }
}
