<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserBankDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserBankDetailsController extends FunctionController
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' =>  ['required', 'string', 'max:191'],
            'lastname' => ['required', 'string', 'max:191'],
            'number' => ['required', 'string', 'max:191', 'unique:user_bank_details'],
        ]);
        if ($validator->passes()) {

            $request->user_id=Auth::user()->id;
            UserBankDetails::create($request->toArray());
            return result_json_success([__('messages.user_bank_details_created')]);

        }
        return result_json_error($validator->errors()->all());

    }
}
