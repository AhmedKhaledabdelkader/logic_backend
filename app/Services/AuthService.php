<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {
    }

    public function login(
        string $username,
        string $password
    ): array {
        $user = $this->authRepository->findByUsername($username);

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => [
                    'The provided credentials are incorrect.',
                ],
            ]);
        }

        if ($user->role !== 'admin') {
            throw ValidationException::withMessages([
                'username' => [
                    'You are not authorized to access the dashboard.',
                ],
            ]);
        }

        $token = $user->createToken(
            'dashboard-token'
        )->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }



public function logout(User $user): void
{
    $token = $user->currentAccessToken();

    if ($token instanceof PersonalAccessToken) {
        $token->delete();
    }
}

}