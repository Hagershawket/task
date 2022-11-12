<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Auth;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComments($id)
  {
      $comments = Comment::orderBy('created_at','desc')->where('post_id',$id)->get();
      return view('home',compact('comments'));
  }


  public function store(CommentRequest $request)
  {
      try
      {         
        $comment = Comment::create([
            'post_id'      => $request->post_id,
            'user_id'      => Auth::user()->id,
            'comment'      => $request->comment,
          ]);
          $data['name']  = $comment->user->name;
          $data['comment']  = $comment->comment;
          $data['created_at']  = $comment->created_at->diffForHumans();
          
          return response()->json([
            'status'       => 200,
            'msg'          => 'Comment Added Successfully',
            'data'         => $data,
          ]);
      } catch(\Exception $ex){
        return response()->json([
          'status'       => 500,
          'msg'          => 'failed',
        ]);
      }
  }
}
