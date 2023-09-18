<?php

namespace NurdauletArtykbaev\CoreAuth\Http\Controllers\Api;

use Illuminate\Http\Request;
use NurdauletArtykbaev\CoreAuth\Http\Requests\PhoneNumberRequest;
use NurdauletArtykbaev\CoreAuth\Http\Requests\VerifyOtpRequest;
use NurdauletArtykbaev\CoreAuth\Services\AuthService;

class AuthController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function requestOtp(PhoneNumberRequest $request)
    {
        $this->loginService->requestOtp($request->phone);

        return response()->json(['data' => null]);
    }

    /**
     * @OA\Post(
     *      path="/auth/login",
     *      operationId="loginAuth",
     *      tags={"Auth"},
     *      summary="Login",
     *      description="Login to get token",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"phone", "code"},
     *            @OA\Property(property="phone", type="integer", format="integer", example="77071115599"),
     *            @OA\Property(property="code", type="integer", format="integer", example="1212"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example="success"),
     *             @OA\Property(property="data",type="object", example="token")
     *          )
     *       )
     *  )
     */
    public function login(VerifyOtpRequest $request)
    {
        $data = $this->authService->login($request->get('phone'), $request->get('code'));

        return response()->json([
            'token' => $data,
            'refresh_token' => $data
        ]);
    }


    public function refreshToken(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $token = $user->createToken("API TOKEN")->plainTextToken;
        return response()->json([
            'token' => $token,
        ]);
    }


    public function register(Request $request)
    {
        $data = $this->authService->register($request->user(), $request->get('name'), $request->get('surname'));

        return response()->json([
            'data' => $data,
            'message' => 'Имя и Фамилия обновлены',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'data' => null,
            'message' => 'Вы вышли из системы',
        ]);
    }
}