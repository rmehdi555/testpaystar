<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 * به دلیل اینکه خواسته شده احراز هویت در نظر گرفته نشود
 * در این تست middleware ایجاد شده که با ارسال id کاربر آن را لاگین میکند
 * وگرنه بهتر بود از یکی از روشی های jwt استفاده شود که کاربر را لاگین کند تا به اطلاعاتش دسترسی داشته باشیم
 * همچنین برای اممنیت روت ها از token استفاده شده است که مقدار آن
 * token = 123456
 */


Route::middleware('api.user.check')->namespace('App\Http\Controllers\Api\v1')->prefix('v1')->group(function () {
    Route::post('/user/bank/details','UserBankDetailsController@insert')->name('userBankDetails.insert');
    Route::post('/transactions/create','TransactionsController@create')->name('transaction.create');
    Route::post('/transactions/request','TransactionsController@request')->name('transaction.request');
    Route::post('/transactions/show','TransactionsController@show')->name('transaction.show');
});
