<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiAccessToken extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $table = 'sc_api_access_token';
}
