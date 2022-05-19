<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TutorSubjectDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ["id"];
    protected $table = 'sc_tutor_subject_details';
}
