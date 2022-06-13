<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TutorAvailability extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    protected $table = 'sc_tutor_availability_master';
    protected $fillable = ['id', 'tutor_id', 'available_datetime', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];
}
