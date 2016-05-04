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
}
