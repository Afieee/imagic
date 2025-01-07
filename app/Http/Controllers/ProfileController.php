<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile(Request $request, $user_id)
    {
        $pengguna = User::findOrFail($user_id);
        $postingan = Post::where('user_id', $user_id)->with('user')->get();

        // Ensure user is set in the session
        if (!$request->session()->has('user')) {
            $request->session()->put('user', $pengguna);
        }

        $user = $request->session()->get('user');

        return view('pages.profile', [
            'postingan' => $postingan,
            'user' => $user,
        ]);
    }
}
