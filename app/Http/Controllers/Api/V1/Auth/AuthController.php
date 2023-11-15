<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::byEmail($request->validated('email'))->firstOrFail();

        if (!Hash::check($request->validated('password'), $user->password)) {
            throw new AuthenticationException(trans('auth.failed'));
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken(now()->timestamp)->plainTextToken
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'user logout'
        ]);
    }

}
