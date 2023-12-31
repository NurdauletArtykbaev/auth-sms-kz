<?php

namespace Nurdaulet\AuthSmsKz\Repositories;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Nurdaulet\AuthSmsKz\Facades\StringFormatter;
use Nurdaulet\AuthSmsKz\Models\User;

class AuthRepository
{

    public function login($phoneNumber, $code)
    {
        $right_value = Cache::get("$phoneNumber/code");

        if (!$right_value) {
            abort( Response::HTTP_BAD_REQUEST,"СМС код был просрочен. Повторите попытку");
        }

        if ($right_value != $code) {
            abort( Response::HTTP_BAD_REQUEST,"Введенный код неверный");
        }

        $user = User::query()->where('phone', $phoneNumber)->first();
        if (empty($user)) {
            $user = $this->createUser($phoneNumber);
        }

        return $user->createToken("API TOKEN")->plainTextToken;
    }

    public function register(User $user, $name, $surname)
    {
        if (!$name) {
            abort(400, "Имя не может быть пустым");
        }

        if (!$surname) {
            abort(400, "Фамилия не может быть пустым");
        }

        $user->save();

        return $user;
    }

    private function createUser($phoneNumber)
    {
        $user = User::where('phone', $phoneNumber)->create([
            'phone' => StringFormatter::onlyDigits($phoneNumber)
        ]);
        return $user;
    }
}