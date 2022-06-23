<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;




class TutorUniversityDetail extends Model

{

    use HasFactory;

    protected $guarded = ["id"];

    protected $table = 'sc_tutor_university_details';

   protected $fillable = ['id', 'tutor_id', 'university_name', 'qualification', 'document_image', 'created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at'];

}

