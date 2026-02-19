<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(Request $r): JsonResponse
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password)
        ]);

        // 1. Buat Profile kosong
        $user->profile()->create();

        // 2. Berikan role menggunakan Spatie (Pastikan role 'student' sudah ada di DB)
        $user->assignRole('student');

        return response()->json([
            'message' => 'Registration successful',
            'token' => $user->createToken('auth')->plainTextToken,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames() // Mengambil nama role
            ]
        ]);
    }

    public function login(Request $r): JsonResponse|array
    {
        $credentials = $r->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['msg' => 'Invalid Credentials'], 401);
        }

        $user = $r->user();
        
        return [
            'token' => $user->createToken('auth')->plainTextToken,
            'user' => [
                'name' => $user->name,
                'roles' => $user->getRoleNames()
            ]
        ];
    }

    public function logout(Request $r): array
    {
        $r->user()->currentAccessToken()->delete();
        return ['msg' => 'Logged out successfully'];
    }
}