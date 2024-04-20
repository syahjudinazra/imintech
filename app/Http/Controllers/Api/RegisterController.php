<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
              $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'email'     => 'required|email|unique:users',
                'password'  => 'required|min:4|confirmed'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password)
            ]);

            if($user) {
                return response()->json([
                    'success' => true,
                    'messsage' => 'Daftar Berhasil!',
                    'user'    => $user,
                ], 201);
            }

            return response()->json([
                'success' => false,
                'messsage' => 'Daftar Gagal!',
            ], 409);
    }
}
