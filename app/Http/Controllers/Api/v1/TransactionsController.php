<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\User;
use App\Models\UserBankDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends FunctionController
{
    //ایجاد تراکنش
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_bank_details_id' =>  ['required', 'numeric','exists:user_bank_details,id'],
            'amount' =>  ['required', 'numeric'],
            'description' => ['required', 'string', 'max:30'],
            'destinationFirstname' => ['required', 'string', 'min:2', 'max:33'],
            'destinationLastname'=> ['required', 'string', 'min:2', 'max:33'],
            'destinationNumber'=> ['required', 'string', 'max:191'],
        ]);
        if ($validator->passes()) {

            $userBankDetails=UserBankDetails::find($request->user_bank_details_id);
            $user=Auth::user();
            if($userBankDetails->user_id!=$user->id)
                return result_json_error([__('messages.user_bank_details_not_in_user')]);

            $data=$request->toArray();
            $data['sourceFirstname']=$userBankDetails->firstname;
            $data['sourceLastname']=$userBankDetails->lastname;
            $data['sourceNumber']=$userBankDetails->number;
            $data['status']='PENDING';
            $data['user_id']=Auth::user()->id;
            $transaction=Transactions::create($data);
            return result_json_success([__('messages.transaction_created').'  ---  transaction_id = '.$transaction->id]);

        }
        return result_json_error($validator->errors()->all());

    }

    // درخواست ارسال تراکنش
    public function request(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'transaction_id' =>  ['required', 'numeric','exists:transactions,id'],
        ]);
        if ($validator->passes()) {

            $transaction=Transactions::find($request->transaction_id);
            $user=Auth::user();
            // بررسی میشود که اطلاعات کارت بانکی مبدا برای یوزر لاگین شده باشد
            if($transaction->user_id!=$user->id)
                return result_json_error([__('messages.transaction_not_in_user')]);

            // ارسال اطلاعات به api
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer transfer-to-deposit-0323'
            ])->acceptJson()->Post(config('app.apiUrl.finnotech').'/oak/v2/clients/1/transferTo?trackId=transfer-to-deposit-032', [
                "amount"=> $transaction->amount ,
                "description"=> $transaction->description  ,
                "destinationFirstname"=> $transaction->destinationFirstname  ,
                "destinationLastname"=> $transaction->destinationLastname  ,
                "destinationNumber"=> $transaction->destinationNumber  ,
                "paymentNumber"=> $transaction->id  ,
                "deposit"=> $transaction->deposit  ,
                "sourceFirstName"=> $transaction->sourceFirstName  ,
                "sourceLastName"=> $transaction->sourceLastName ,
            ]);

            // دریافت اطلاعات
            $response=$response->json();


            if($response["status"]=="DONE")
            {
                $result=$response["result"];
                if($result["paymentNumber"] == $transaction->id and $result["amount"] == $transaction->amount and $result["destinationNumber"] == $transaction->destinationNumber)
                {
                    $transaction->update([
                        'status'=>'DONE',
                        'inquiryDate'=>$request["inquiryDate"],
                        'inquirySequence'=>$request["inquirySequence"],
                        'inquiryTime'=>$request["inquiryTime"],
                        'message'=>$request["message"],
                        'refCode'=>$request["refCode"],
                        'type'=>$request["type"],
                    ]);
                    return result_json_success(['DONE']);
                }else{// اگر اطلاعات دریافتی با اطلاعات ارسالی مغایرت داشته باشد
                    return result_json_error([__('messages.contradiction_in_information')]);
                }

            }else{//اگر پاسخ دریافتی FALLED باشد
                $transaction->update([
                    'status'=>'FAILED',
                ]);
                return result_json_error([$response["error"]["message"]]);
            }


        }
        return result_json_error($validator->errors()->all());

    }

    // نمایش تراکنش های کاربر
    public function show(Request $request)
    {

        $user=Auth::user();
        $transaction=Transactions::where('user_id','=',$user->id)->get()->toArray();
        return result_json($transaction);

    }
}
