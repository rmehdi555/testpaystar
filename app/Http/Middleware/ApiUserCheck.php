<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'numeric'],
            'token' => ['required'],
        ]);
        if ($validator->passes())
        {
            if ($request->token!="123456")
                return result_json_error([__('messages.the_token_is_not_correct')]);
            $user=User::find($request->user_id);

            if(!isset($user->id))
                return result_json_error([__('messages.user_not_find')]);

            Auth::login($user);
            return $next($request);

        }
        return result_json_error($validator->errors()->all());
    }
}
