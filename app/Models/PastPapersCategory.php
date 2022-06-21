<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastPapersCategory extends Model
{

    use HasFactory;
    protected $guarded = ["id"];
    protected $table = 'sc_past_papers_category';
    protected $fillable = ['id','category_name', 'created_by', 'created_at', 'updated_at','updated_by','deleted_at','deleted_by'];

}
