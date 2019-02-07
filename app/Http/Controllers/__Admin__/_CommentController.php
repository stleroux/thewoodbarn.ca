<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
// use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;
use App\Post;
use Session;
use Log;
use Auth;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
  // ================================================================================================================================
  // CONSTRUCT ::
  // ================================================================================================================================
  public function __construct()
  {
    $this->middleware('auth', ['except' => 'store']);
    Log::useFiles(storage_path().'/logs/Admin_Comments.log');

  }

  // ================================================================================================================================
  // STORE :: Store a newly created resource in storage.
  // ================================================================================================================================
  public function store(CreateCommentRequest $request, $post_id)
  {
    $post = Post::find($post_id);

    $comment = new Comment();
      $comment->name = $request->name;
      $comment->email = $request->email;
      $comment->comment = $request->comment;
      $comment->approved = true;
      $comment->post()->associate($post);
    $comment->save();

    // Save entry to log file using built-in Monolog
    if (Auth::check()) {
      Log::info(Auth::user()->username . " (" . Auth::user()->id . ") COMMENTED on post (" . $post->id . ")\r\n", [json_decode($comment, true)]);
    } else {
      Log::info('Guest commented on post (' . $comment->id) . ')';
    }

    Session::flash('success', 'Comment was added');
    return redirect()->route('admin.blog.single', [$post->slug]);
  }

  // ================================================================================================================================
  //  EDIT :: Show the form for editing the specified resource.
  // ================================================================================================================================
  public function edit($id)
  {
    $comment = Comment::find($id);
    return view('admin.comments.edit' , compact('comment'));
  }

  // ================================================================================================================================
  // UPDATE :: Update the specified resource in storage.
  // ================================================================================================================================
  public function update(UpdateCommentRequest $request, $id)
  {
    $comment = Comment::find($id);
      $comment->comment = $request->comment;
    $comment->save();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED comment (" . $comment->id . ")\r\n", 
        [json_decode($comment, true)]
    );

    Session::flash('success', 'Comment updated');
    return redirect()->route('admin.posts.show', $comment->post->id);
  }

  // ================================================================================================================================
  // DELETE :: Show the resource delete confirmation page.
  // ================================================================================================================================
  public function delete($id)
  {
    $comment = Comment::find($id);
    return view('admin.comments.delete', compact('comment'));
  }

  // ================================================================================================================================
  // DESTROY :: Remove the specified resource from storage.
  // ================================================================================================================================
  public function destroy($id)
  {
    $comment = Comment::find($id);
    $post_id = $comment->post->id;
    $comment->delete();

    // Save entry to log file using built-in Monolog
    Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED comment (" . $comment->id . ")\r\n", 
        [json_decode($comment, true)]
    );

    Session::flash('success', 'Comment Deleted');
    return redirect()->route('admin.posts.show', $post_id);
  }

}
