<?php

namespace App;

use App\Page;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'visible', 'position'];


    /**
     * Get the pages that belong to the subject.
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

   

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
