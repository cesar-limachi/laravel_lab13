<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Notifications\NotificationComment;
use App\Models\User;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required:mex:250',
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->content = $request->get('content');

        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        $title = $post->title;
        $id_user = $post->user_id;
        User::find($id_user)->notify(new NotificationComment($comment, $title));

        return redirect()->route('post', ['id' => $request->get('post_id')]);
    }
}
