<?php

namespace App\Repositories;

use App\User;
use App\Subject;
use App\Page;

class SubjectRepository
{
    /**
     * Get all of the subjects for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Subject::where('user_id', $user->id)
                    ->orderBy('position', 'asc')
                    ->get();
    }

    /**
     * Get all of the visible subjects for a given user.
     *
     * @param  User  $user
     * @return Collection
     */

    public function subjectsVisible(User $user)
    {
        return Subject::where('user_id', $user->id)
                    ->where('visible', 1)
                    ->orderBy('position', 'asc')
                    ->get();
    }

    /**
     * Get all of the pages for a given subject.
     *
     * @param  User  $user
     * @return Collection
     */
    public function hasPages(Subject $subject)
    {
        return Page::where('subject_id', $subject->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function showPages(Subject $subject)
    {
        return Page::where('subject_id', $subject->id)
                    ->where('user_id', $subject->user_id)
                    ->where('visible', 1)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

}
