<?php

namespace App;
use App\User;
use App\Subject;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'visible', 'position', 'content', 'subject_id'];
    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject that belongs the task.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getSubjectId(Page $page)
    {
        return Subject::where('id', $page->subject_id)
                    ->where('user_id', $page->user_id)
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
