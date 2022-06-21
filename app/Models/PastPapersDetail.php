<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastPapersDetail extends Model
{

    use HasFactory;
    protected $guarded = ["id"];
    protected $table = 'sc_past_papers_detail';
    protected $fillable = ['id','paper_id','subject_paper_title','upload_paper','upload_mark_scheme', 'created_by', 'created_at', 'updated_at','updated_by','deleted_at','deleted_by'];

}
