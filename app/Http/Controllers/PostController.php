<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Like;
use App\Models\Tag;
use App\Models\Photo;
use App\Models\PostTag;
use Auth;

class PostController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $posts = Post::Active()->orderBy('created_at','desc')->where('user_id',Auth::user()->id)->get();
      $tags  = Tag::get();
      return view('home',compact('posts','tags'));
  }

  public function store(PostRequest $request)
  {
      try
      {         
        $post = Post::create([
            'user_id'      => Auth::user()->id,
            'title'        => $request->title,
            'description'  => $request->description,
          ]);
          $data='';
          if ($request->hasfile('photos')) {
              foreach ($request->file('photos') as $file) {
                  $data = uploadImage('posts', $file);
                  $post->photos()->create([
                    'data'      => $data,
                  ]);
              }
          } 
          $post->tags()->attach($request->tags);
          return response()->json([
            'status'       => 200,
            'msg'          => 'Post Added Successfully',
            'data'         => $post,
          ]);
      } catch(\Exception $ex){
        return response()->json([
          'status'       => 500,
          'msg'          => 'failed',
        ]);
      }
  }

  public function destroy(Request $request)
  {
    $post = Post::find($request->postId);
    if($post)
    {
      $post->delete();
      return response()->json([
        'status'       => 200,
        'msg'          => 'Post Deleted Successfully',
      ]);
    }
    else
    {
      return response()->json([
        'status'       => 500,
        'msg'          => 'Somthing Went Wrong',
      ]);
    }
    
  }

  public function posts($id)
  {
      $tag = Tag::where('id', $id)->first();
      return view('posts',compact('tag'));
  }

  public function likePost(Request $request)
  {
      try
      {
        $user = Auth::user();
        $postId = $request->postId;
        $isLike = $request->isLike;
        $post = Post::find($postId);
        $like = $user->likes()->where('post_id', $postId)->first();
        if($like)
        {
          $like->like = 0;
          $like->delete();
        }
        else
        {
          $like = Like::create([
            'post_id' => $postId,
            'user_id' => $user->id,
            'like'    => 1,
          ]);
        } 
        return response()->json([
          'status'       => 200,
          'msg'          => 'You Liked this post!',
          'isLike'       => $like->like,
        ]);
      } catch(\Exception $ex){
        return response()->json([
          'status'       => 500,
          'msg'          => 'failed',
        ]);
      }

  }


  
}