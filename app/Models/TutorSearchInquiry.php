<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TutorSearchInquiry extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ["id"];
    protected $table = 'sc_tutor_search_inquiry';
   protected $fillable = ['id', 'tuition_often', 'subject','level','created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at'];
   
}
