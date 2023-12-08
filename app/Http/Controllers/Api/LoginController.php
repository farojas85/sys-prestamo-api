<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * login session
     * @param Request $request
     *
     * @return [type]
     */
    public function Login(Request $request) {
        return User::authtenticate($request);
    }

    /**
     * logout session
     * @param Request $request
     *
     * @return [type]
     */
    public function logoutSession(Request $request) {
        return User::logout($request);
    }

}
