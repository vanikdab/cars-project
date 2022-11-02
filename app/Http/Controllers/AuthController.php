<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      operationId="getAuthToken",
     *      tags={"Auth"},
     *      summary="Get a JWT via given credentials",
     *      description="Get a JWT via given credentials",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#Illuminate/Http/Request|null|string")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#Illuminate/Http/JsonResponse")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       )
     *     )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
