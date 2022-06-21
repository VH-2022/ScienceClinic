<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ["id"];
    protected $table = 'sc_feedback';

    public function subjectDetails()
    {
        return $this->hasOne(SubjectMaster::class, 'id', 'subject_id');
    }
    public function userDetails()
    {
        return $this->hasOne(User::class, 'id', 'parent_id');
    }
}
