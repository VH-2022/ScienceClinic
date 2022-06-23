<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastPapers extends Model
{

    use HasFactory;
    protected $guarded = ["id"];
    protected $table = 'sc_past_papers';
    protected $fillable = ['id','paper_category_id','paper_title','subject_id','paper_sub_title', 'created_by', 'created_at', 'updated_at','updated_by','deleted_at','deleted_by'];


    public function subjectData(){
        return $this->hasOne(SubjectMaster::class, 'id', 'subject_id');
    }
    public function paperdetailData()
    {
        return $this->hasMany(PastPapersDetail::class, 'paper_id', 'id');
    }

}
