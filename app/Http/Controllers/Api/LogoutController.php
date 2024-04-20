<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
                $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

                if($removeToken) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Logout Berhasil!',
                    ]);
                }
    }
}
