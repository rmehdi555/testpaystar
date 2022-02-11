<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'user_bank_details_id',
        'amount',  //مبلغ تراکنش
        'description',  //شرح تراکنش
        'destinationFirstname',  //نام صاحب حساب مقصد
        'destinationLastname',  //نام خانوادگی صاحب حساب مقصد
        'destinationNumber',  //شماره حساب مقصد
        'inquiryDate',  // این اطلاعات در صورت بروز مغایرت احتمالی برای رفع مغایرت باید به بانک ارایه گردد
        'inquirySequence',  // این اطلاعات در صورت بروز مغایرت احتمالی برای رفع مغایرت باید به بانک ارایه گردد
        'message', //در صورتی بروز خطا، پیغام خطا در این فیلد قرار میگیرد
        'refCode',  //شناسه پرداخت
        'sourceFirstname',  // نام صاحب حساب مبدا
        'sourceLastname',  //نام خانوادگی صاحب حساب مبدا
        'sourceNumber',  //شماره حساب مبدا
        'type',/*
                نوع انتقال وجه
                internal: انتقال وجه داخلی
                paya: انتقال وجه پایا
                */
        'status',/*
                 وضعیت فراخوانی سرویس
                DONE: فراخوانی موفق سرویس
                FAILED: فراخوانی ناموفق سرویس
                PENDING : در حال انتظار برای پاسخ
                */
    ];
}
