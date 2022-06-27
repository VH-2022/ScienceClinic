<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentPayment extends Model
{

    use HasFactory;
    protected $guarded = ["id"];
    protected $table = 'sc_parent_payment';
    protected $fillable = ['id','user_inquiry_id', 'user_id', 'pay_amount','total_commision','payment_type', 'payment_status', 'payment_json', 'created_at', 'created_by', 'updated_at','updated_by','deleted_at','deleted_by'];

    public function userDetails()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function parentDetail()
    {
        return $this->hasOne(ParentDetail::class, 'id', 'user_inquiry_id');
    }

}
