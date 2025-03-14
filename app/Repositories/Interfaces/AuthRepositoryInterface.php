<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function attemptLogin(array $credentials, bool $remember = false): bool;
    public function logout(Request $request): void;
    public function register(array $userData);
    public function sendPasswordResetLink(string $email): string;
    public function resetPassword(array $data, ?callable $callback): string;
}