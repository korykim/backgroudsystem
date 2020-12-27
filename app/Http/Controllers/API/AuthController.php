<?php

namespace App\Http\Controllers\API;

use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Encore\Admin\Controllers\AuthController as ac;
use Illuminate\Support\Facades\Auth;


class AuthController extends ac
{
    //
    public function index(){
        return "hello";
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postLogin(Request $request)
    {
        $this->loginValidator($request->all())->validate();

        $credentials = $request->only([$this->username(), 'password']);
        $remember = $request->get('remember', false);


        if ($this->guard()->attempt($credentials)) {

            $user = Admin::user();
            //$success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
            //dd($user);
            return $user;

//            return response()->json(['success' => $success], 200);
        } else {
            //return response()->json(['error' => 'Unauthorized'], 401);
            return "bad";
        }

    }
}
