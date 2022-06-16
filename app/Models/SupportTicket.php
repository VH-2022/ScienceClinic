<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class SupportTicket extends Model

{

    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    protected $table = 'sc_support_ticket';

    public function userDetails()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}

