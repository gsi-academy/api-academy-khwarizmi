<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $r)
    {
        // Memuat profil beserta data user dasar jika diperlukan
        return $r->user()->load('profile');
    }

    public function update(Request $r)
    {
        $profile = $r->user()->profile;
        $profile->update($r->all());

        return $profile;
    }

    /**
     * Mengambil daftar mentor unik dari kursus yang diikuti user
     */
    public function getMyMentors(Request $request)
    {
        $user = $request->user();

        // Mengambil user dengan role mentor yang terkait dengan enrollment student saat ini
        return User::role('mentor')
            ->whereHas('lessons.course.enrollments', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->distinct()
            ->get(['id', 'name'])
            ->map(function ($mentor) {
                return [
                    'name' => $mentor->name,
                    'role' => 'Professional Mentor',
                    'img' => "https://ui-avatars.com/api/?name=" . urlencode($mentor->name) . "&background=random"
                ];
            });
    }
}