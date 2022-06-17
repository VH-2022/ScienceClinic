<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineTutoring extends Model
{

    use HasFactory;
    protected $guarded = ["id"];
    protected $table = 'sc_online_tutoring';
    protected $fillable = ['id','user_id', 'online_tutoring_name', 'online_tutoring_link', 'created_at', 'created_by', 'updated_at','updated_by','deleted_at','deleted_by'];

    public function userDetails()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    

}
