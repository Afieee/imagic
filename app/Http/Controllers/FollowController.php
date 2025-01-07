<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggleFollow(Request $request, $user_id)
    {
        // Ambil ID user yang sedang login dari session
        $id_following = $request->session()->get('user')->id;

        // Cari user yang ingin di-follow
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found']);
        }

        // Cek apakah sudah ada relasi follow antara user yang login dan user yang ingin di-follow
        $follow = Follow::where('id_following', $id_following)
            ->where('id_followed', $user_id)
            ->first();

        if ($follow) {
            // Jika sudah ada relasi, ubah status `follow` menjadi kebalikannya
            $follow->follow = !$follow->follow;
            $follow->save();

            // Ambil jumlah follower terbaru
            $newFollowerCount = $user->followers()->count();

            // Mengembalikan status dan jumlah follower terbaru
            return response()->json([
                'status' => $follow->follow ? 'followed' : 'unfollowed',
                'newFollowerCount' => $newFollowerCount
            ]);
        } else {
            // Jika belum ada relasi, tambahkan data baru dengan status `follow = true`
            Follow::create([
                'id_following' => $id_following,
                'id_followed' => $user_id,
                'follow' => true,
            ]);

            // Ambil jumlah follower terbaru setelah follow
            $newFollowerCount = $user->followers()->count();

            // Mengembalikan status dan jumlah follower terbaru
            return response()->json([
                'status' => 'followed',
                'newFollowerCount' => $newFollowerCount
            ]);
        }
    }
}
