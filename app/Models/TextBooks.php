<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class TextBooks extends Model

{

    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    protected $table = 'sc_text_books';

    public function userDetails()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}

