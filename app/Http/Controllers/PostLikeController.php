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

        // Cari apakah sudah ada like dari user pada post ini
        $like = PostLike::where('id_post', $idPost)
            ->where('id_users', $userId)
            ->first();

        if ($like) {
            // Jika sudah ada, hapus like tersebut
            $like->delete();
        } else {
            // Jika belum ada like, buat like baru
            PostLike::create([
                'id_post' => $idPost,
                'id_users' => $userId,
                'like' => true,
            ]);
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Tindakan berhasil dilakukan!');
    }
}
