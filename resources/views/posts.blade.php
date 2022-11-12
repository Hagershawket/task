@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           <nav class="navbar navbar-light bg-white">
    <a href="#" class="navbar-brand">Bootsbook</a>
</nav>


<div class="container-fluid gedf-wrapper">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="h5">@ {{Auth::user()->name}}</div>
                    <div class="h7 text-muted">Fullname : {{Auth::user()->name}}</div>
                    <div class="h7">Developer of web applications, JavaScript, PHP, Java, Python, Ruby, Java, Node.js,
                        etc.
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="h6 text-muted">Followers</div>
                        <div class="h5">5.2342</div>
                    </li>
                    <li class="list-group-item">
                        <div class="h6 text-muted">Following</div>
                        <div class="h5">6758</div>
                    </li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 gedf-main">
                <!--- \\\\\\\Post-->
                @foreach ($tag->posts as $post)
                @csrf
                <div class="card gedf-card post-container">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                </div>
                                <input type="hidden" name="postId" class="postId" value="{{$post->id}}">
                                <div class="ml-2">
                                    <div class="h5 m-0">@ {{$post->user->name}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <button class="deletePost dropdown-item" value="{{$post->id}}">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{$post->created_at->diffForHumans()}}</div>
                        <a class="card-link" href="#">
                            <h5 class="card-title">{{$post->title}}</h5>
                        </a>

                        <p class="card-text">
                            {{$post->description}}
                        </p>
                        @foreach ( $post->tags as $tag )
								<a href="{{route('posts',$tag->id)}}" class="badge badge-Pill badge-danger" style="background-color: #ee4266;"> 
									{{$tag->tag}} 
								</a>
						@endforeach
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-link like" style={{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? "color: #007bff;" : "color: grey;" : "color: grey;"}}><i class="fa fa-thumbs-up"></i> {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Like' : 'Like' : 'Like'  }}</a>
                        <a href="#" class="card-link comment" style="color: grey;"><i class="fa fa-comment"></i> Comment</a>
                    </div>
                </div>
                <br>
                @endforeach
                <!-- Post /////-->
                


        </div>
        <div class="col-md-3">
            <div class="card gedf-card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
            <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
        </div>
    </div>
</div> 
    </div>
</div>
@endsection
@section('js')
<script>

    $(document).ready(function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    })
    $(document).on('click','.deletePost', function(event){
        if(confirm('Are you sure you want to delete this post ?'))
        {
            var post = $(this);
            var postId = post.val();
            /**Ajax code**/
            $.ajax({
                type: "POST",
                url:  "{{ route('posts.destroy') }}",
                data:{
                    postId:postId,
                },
                success: function (res) {
                        if (res.status == 200) 
                        {
                            alert(res.msg);
                            post.closest('.post-container').remove();
                        }
                        else
                            alert(res.msg);
                    }
                });
        }
    });

});
</script>
@endsection
