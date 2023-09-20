<?php

namespace Nurdaulet\AuthSmsKz\Http\Controllers\Api;

use Illuminate\Http\Request;
use Nurdaulet\AuthSmsKz\Http\Requests\PhoneNumberRequest;
use Nurdaulet\AuthSmsKz\Http\Requests\VerifyOtpRequest;
use Nurdaulet\AuthSmsKz\Models\User;
use Nurdaulet\AuthSmsKz\Services\AuthService;

class AuthController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function requestOtp(PhoneNumberRequest $request)
    {
        $this->authService->requestOtp($request->phone);

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
            'data' =>[
                'token' => $data,
            ]
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
        $ref = new \ReflectionClass($request->user());
        dd($request->user()->getAttributes(), (new User())->getAttributes());
        $request->user()->tokens()->delete();

        return response()->json([
            'data' => null,
            'message' => 'Вы вышли из системы',
        ]);
    }
}
