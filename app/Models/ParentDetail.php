<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentDetail extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $table = 'sc_parent_inquiry_details';
    protected $fillable = ['id', 'user_id', 'subject_id', 'level_id', 'tuition_day', 'tuition_time',  'created_by', 'updated_by', 'deleted_by', 'deleted_at','created_at', 'updated_at', 'tutor_id'];

    public function tutorDetails()
    {
        return $this->hasOne(User::class, 'id', 'tutor_id');
    }
    public function subjectDetails()
    {
        return $this->hasOne(SubjectMaster::class, 'id', 'subject_id');
    }
    public function levelDetails()
    {
        return $this->hasOne(TutorLevel::class, 'id', 'level_id');
    }
}
