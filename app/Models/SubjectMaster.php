<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectMaster extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ["id"];
    protected $table = 'sc_subject_master';
    public function subjectmaster()
    {
        return $this->belongsTo(SubjectMaster::class, 'id', $this->parent_id);
    }
    public static function getAllData($subject, $level, $post_code)
    {
        $temp = '';
        if ($subject != '') {
            $temp .= ' main_title LIKE"' . '%' . $subject . '%' . '"';
        }
        if ($level != '') {
            
            $temp .= " AND sc_tutor_level.title LIKE '%" . $level . "%'";
        }
        // if ($post_code != '') {
        //     $temp .= " AND FirstName LIKE '%" . $post_code . "%'";
        // }
        $query = SubjectMaster::select('main_title')
            // ->leftjoin('sc_tutor_subject_details', function ($join) {
            //     $join->on('sc_subject_master.id', '=', 'sc_tutor_subject_details.subject_id');
            // })
            // ->leftjoin('users', function ($join) {
            //     $join->on('sc_tutor_subject_details.tutor_id', '=', 'users.id');
            // })
            ->whereRaw($temp)->toSql();
        return $query;
    }
}
