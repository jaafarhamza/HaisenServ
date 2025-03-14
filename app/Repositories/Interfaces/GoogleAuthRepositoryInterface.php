<?php

namespace App\Repositories\Interfaces;

interface GoogleAuthRepositoryInterface
{
    public function redirectToGoogle();
    public function handleGoogleCallback();
}