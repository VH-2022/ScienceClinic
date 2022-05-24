<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class TutorDetail extends Model

{

    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    protected $table = 'sc_tutor_details';

   protected $fillable = ['id', 'tutor_id', 'subject_to_wish_tutor', 'level_to_wish_tutor', 'dbs_disclosure', 'experience_in_uk', 'total_experience_in_uk', 'pay_tex', 'created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at','document'];

 

}

