<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\User as ResourcesUser;
use App\Http\Controllers\Api\BaseController as BaseController;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:4'],
            'email' => 'required|unique:users,email|email',
            'password' => ['required', 'min:8'],
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors(), 'Validation Fail', 400);
        }

        $name = $request->input('name');
        $email = $request->input('email');

        $password = $request->input('password');
        $hashpassword = Hash::make($password);

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = $hashpassword;
        $user->save();


        $responeuser = User::find($user->id);

        return $this->sendSuccessResponse(new ResourcesUser($responeuser), 'User Created Successfuly! back to login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors(), 'Validation Fail', 400);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();

            $token = $user->createToken('LARAVELAUTHAPI')->accessToken;

            $response = [
                'user' => new ResourcesUser($user),
                'token' => $token
            ];

            return $this->sendSuccessResponse($response, 'Login Successfully');
        }else{
            return $this->sendErrorResponse("Unathenticated", "credential soesnaot match", 401);
        }
        
    }
}
