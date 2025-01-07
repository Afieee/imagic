<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function halamanComment(Request $request, $id_post)
    {
        $user = $request->session()->get('user');
        $post = Post::findOrFail($id_post);
        $comments = Comment::with('post', 'user')->where('id_post', $id_post)->get();

        return view('pages.comment', [
            'post' => $post,
            'user' => $user,
            'comments' => $comments,
        ]);
    }


    public function tambahComment(Request $request)
    {
        $data = [
            'comment' => $request->comment,
            'id_post' => $request->id_post,
            'id_user' => $request->id_user,
        ];

        Comment::create($data);

        return redirect()->back()->with('success', 'Commented');
    }
}
