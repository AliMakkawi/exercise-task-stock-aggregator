<?php

declare(strict_types=1);

namespace App\UserManagement\Application\Services;

use App\UserManagement\Domain\Models\User;

final class UserService
{
    public function create(array $validatedData): string
    {
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        $token = $user->createToken('stocks-api-fetch-token', ['fetch-stocks']);

        return $token->plainTextToken;
    }
}
