<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBankDetails extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'firstname', //  نام
        'lastname', //  نام خانوادگی
        'number'  //  شماره حساب
    ];

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }

}
