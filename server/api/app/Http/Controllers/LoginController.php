<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Security\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $authInfo = Auth::getUserInfo();

        if(empty($authInfo)){
            return response()->json([
                'code' => 400,
                'message' => 'User not found'
            ], 400);
        }

        $token = Auth::getToken($authInfo['user']->id);

        $res = response()->json($authInfo);
        $res->withCookie(cookie('auth', $token, 0));
        return $res;
    }

    public function ping(Request $req){
        $authInfo = Auth::getUserInfo();

        if(empty($authInfo)){
            $res = response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ], 401);
            $res->withCookie(cookie('auth', null, 0));
            return $res;
        } else {
            return response()->json([
                "ts" => time(),
                "authInfo" => $authInfo
            ]);
        }
    }

    public function logout(){
        $res = response()->json('ok');
        $res->withCookie(cookie('auth', '', 0));
        return $res;
    }
}
