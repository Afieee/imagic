<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile(Request $request, $user_id)
    {
        $postingan = Post::where('user_id', $user_id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        $tangkep = $request->$user_id;
        $jumlahFollower = Follow::where('id_followed', $user_id)
            ->where('follow', 1)
            ->count();


        $user = Auth::user();

        return view('pages.profile', [
            'postingan' => $postingan,
            'user' => $user,
            'jumlahFollower' => $jumlahFollower,
            'tangkep' => $tangkep,
        ]);
    }

    public function setting($sessionId)
    {
        $session = Auth::user();
        $profile = User::findOrFail($sessionId);

        return view('pages.setting', ['profile' => $profile, 'user' => $session]);
    }

    public function updateProfile(Request $request, $sessionId)
    {


        $user = User::findOrFail($sessionId);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
        ]);

        return redirect()->route('halaman-home');
    }
}
