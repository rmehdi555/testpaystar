<?php

if (!function_exists('result_json_error')) {

    function result_json_error(Array $messages)
    {
        return response()->json([
            'type'=>'error',
            'message'=>$messages,
            'status'=>'0'
        ], 400);

    }
}
if (!function_exists('result_json_success')) {

    function result_json_success(Array $messages)
    {
        return response()->json([
            'type'=>'success',
            'message'=>$messages,
            'status'=>'1'
        ], 200);

    }
}

if (!function_exists('result_json')) {

    function result_json(Array $result)
    {
        return response()->json([
            'type'=>'success',
            'result'=>$result,
            'status'=>'1'
        ], 200);

    }
}

