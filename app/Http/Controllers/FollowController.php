<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggleFollow(Request $request, $user_id)
    {
        $id_following = $request->session()->get('user')->id;

        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found']);
        }
        $follow = Follow::where('id_following', $id_following)
            ->where('id_followed', $user_id)
            ->first();

        if ($follow) {
            $follow->follow = !$follow->follow;
            $follow->save();
            $newFollowerCount = $user->followers()->count();

            return response()->json([
                'status' => $follow->follow ? 'followed' : 'unfollowed',
                'newFollowerCount' => $newFollowerCount
            ]);
        } else {
            Follow::create([
                'id_following' => $id_following,
                'id_followed' => $user_id,
                'follow' => true,
            ]);

            $newFollowerCount = $user->followers()->count();

            return response()->json([
                'status' => 'followed',
                'newFollowerCount' => $newFollowerCount
            ]);
        }
    }
}
