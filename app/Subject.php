<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $guarded = [];
    public function students()
    {
        return $this->belongsToMany('App\Student', 'student_subject', 'subject_id','student_id')
            ->withPivot(["rating"]);
    }
}
