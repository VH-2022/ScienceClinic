<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TutorLevelDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ["id"];
    protected $table = 'sc_tutor_level_details';
   protected $fillable = ['id', 'tutor_id', 'level_id','created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at'];
}
