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

   protected $fillable = ['id', 'tutor_id', 'subject_id','created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at'];

   public function subjectMasters()

   {
       return $this->belongsTo(SubjectMaster::class, 'subject_id', 'id');
   }
    public function getLevelDetail()
    {
        return $this->hasOne(TutorLevel::class, 'id', 'subject_id');
    }

}

