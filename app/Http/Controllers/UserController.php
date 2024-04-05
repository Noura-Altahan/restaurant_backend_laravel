<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \App\ReturnResult;
use \App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $result = new ReturnResult();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $result->setError403('Please Check all Required Fields');
            return response()->json($result, 403);
        }
        if (
            Auth::attempt([
                'name' => $request->name,
                'password' => $request->password,
                'is_active' => 1,
                'is_admin' => 1
            ])
        ) {
            $user = User::where('id', Auth::user()->id)->first();
            $token = $user->createToken("mytoken")->plainTextToken;
            $result->data = ["name" => $user->name, "api_token" => $token];

            return response()->json($result);
        } else {
            $result->setError403('Wrong Credentials');
            return response()->json($result, 403);
        }
    }
}
