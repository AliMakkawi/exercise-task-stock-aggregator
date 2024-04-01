<?php

namespace App\Http\Controllers;

use App\UserManagement\Application\Services\UserService;
use App\UserManagement\Domain\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class, 'email')],
        ]);

        return response()->json(['api_token' => $this->userService->create($validatedData)], 201);

    }
}
