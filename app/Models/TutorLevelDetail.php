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
    public function tutorLevelRelation(){
        return $this->belongsTo(TutorLevel::class, 'level_id', 'id');
    }
    public function level()
    {
        return $this->hasOne(TutorLevel::class, 'id', 'level_id');
    }
}
