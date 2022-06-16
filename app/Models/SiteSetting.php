<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{

    use HasFactory;
    protected $guarded = ["id"];
    protected $table = 'sc_site_setting';
    protected $fillable = ['id', 'commission_value','created_by','created_at','updated_by', 'updated_at','deleted_by','deleted_at'];
}
