<?php

namespace App\Repositories;

use App\User;
use App\Page;
use App\Subject;

class PageRepository
{
    /**
     * Get all of the pages for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Page::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }


    /**
     * Get all of the pages for a given subject.
     *
     * @param  Page  $page
     * @return Collection
     */
    public function forSubject(Subject $subject)
    {
        return Page::where('subject_id', $subject->id)
                    ->where('user_id', $subject->user_id)
                    ->where('visible', 1)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}
