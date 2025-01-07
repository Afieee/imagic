<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function toggleLike(Request $request)
    {
        $idPost = $request->input('id_post');
        $userId = Auth::id();
        $like = PostLike::where('id_post', $idPost)
            ->where('id_users', $userId)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            PostLike::create([
                'id_post' => $idPost,
                'id_users' => $userId,
                'like' => true,
            ]);
        }

        return back()->with('success', 'Thank you!');
    }
}
