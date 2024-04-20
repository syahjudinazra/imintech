<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
                $validator = Validator::make($request->all(), [
                    'name'     => 'required',
                    'password'  => 'required'
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $credentials = $request->only('name', 'password');

                if(!$token = auth()->guard('api')->attempt($credentials)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Nama atau Password Anda salah'
                    ], 401);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Login Berhasil!',
                    'user'    => auth()->guard('api')->user(),
                    'token'   => $token
                ], 200);
    }
}
