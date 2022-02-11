<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    public function resultJsonError($messages)
    {
        return response()->json([
            'type'=>'error',
            'message'=>$messages,
            'status'=>'0'
        ], 400);
    }

    public function resultJsonSuccess($messages)
    {
        return response()->json([
            'type'=>'success',
            'message'=>$messages,
            'status'=>'1'
        ], 200);
    }
}
