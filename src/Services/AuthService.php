<?php
namespace Nurdaulet\AuthSmsKz\Services;

use Illuminate\Support\Facades\Cache;
use Nurdaulet\AuthSmsKz\Facades\StringFormatter;
use Nurdaulet\AuthSmsKz\Models\User;
use Nurdaulet\AuthSmsKz\Repositories\AuthRepository;

class AuthService
{
    public function __construct(private AuthRepository $authRepository)
    {
    }

    public function requestOtp($phone)
    {
        $phone = StringFormatter::onlyDigits($phone) ;
        $code = rand(1000, 9999);
        $user = User::wherePhone($phone)->first();

        if (!app()->isProduction()) {
            $code = $phone % 10000;
        } else {
            if (!empty($user) && $user->code) {
                $code = $user->code;
            }else  {
                \SmsKz::to($phone)->text(env('app_name'). " код: $code")->send();
            }
        }

        Cache::put("$phone/code", $code, 120);
    }

    public function login($phoneNumber, $code)
    {
        return $this->authRepository->login($phoneNumber, $code);
    }

    public function register(User $user, $name, $surname)
    {
        return $this->authRepository->register($user, $name, $surname);
    }


}