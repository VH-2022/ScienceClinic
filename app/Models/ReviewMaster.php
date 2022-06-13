<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewMaster extends Model
{

    use HasFactory;
    protected $guarded = ["id"];
    protected $table = 'sc_review_master';
    protected $fillable = ['id', 'tutor_id', 'descriptions', 'subject', 'outcome', 'rating', 'created_at', 'updated_at'];
}
