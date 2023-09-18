<?php
namespace NurdauletArtykbaev\CoreAuth\Services;

class AuthService
{
    public function __construct(private AuthRepository $authRepository, private UserService $userService)
    {
    }

    public function requestOtp($phone)
    {
        $phone = StringFormatter::onlyDigits($phone) ;
        $code = rand(1000, 9999);
        $user = User::wherePhone($phone)->first();
        if ($user?->id) {
            $this->userService->checkBanned($user);
        }

        if (!app()->isProduction()) {
            $code = $phone % 10000;

        } else {
            if (!empty($user) && $user->code) {
                $code = $user->code;
            }else if($phone != '77477628577') {
                \SMS::to($phone)->text("Naprocat.kz код: $code")->send();
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