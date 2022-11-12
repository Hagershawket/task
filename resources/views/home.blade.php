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
            <div class="card gedf-card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                                a publication</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tags-tab" data-toggle="tab" role="tab" aria-controls="tags" aria-selected="false" href="#tags">tags</a>
                        </li>
                    </ul>
                </div>
                <form data-action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="add-post-form">
                    @csrf
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <div class="form-group">
                                    <label class="sr-only" for="message">post</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Write a title"><br>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="What are you thinking?"></textarea>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" name="photos[]" class="custom-file-input" id="customFile" multiple>
                                        <label class="custom-file-label" for="customFile">Upload image</label>
                                    </div>
                                </div>
                                <div class="py-4"></div>
                            </div>
                            <div class="tab-pane fade" id="tags" role="tabpanel" aria-labelledby="tags-tab">
                                <div class="form-group">
                                    <div class="form-check">
                                        @foreach($tags as $tag)
                                            <input class="" type="checkbox"  name="tags[]" value="{{ $tag->id }}" >
                                            <label class=""> {{ $tag->tag }} </label>
                                                &nbsp;&nbsp;
                                        @endforeach
                                    </div>
                                </div>
                                <div class="py-4"></div>
                            </div>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">share</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <br>
                <!-- Post /////-->
                {{-- <div id="post-card"></div><br> --}}
                <!--- \\\\\\\Post-->
                @foreach ($posts as $post)
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
                        <a><span>{{$post->likes()->count()}}</span></a>
                        <a href="#" class="card-link like"><i class="fa fa-thumbs-up"></i> {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Like' : 'Like' : 'Like'  }}</a>&nbsp;&nbsp;
                        <a><span>{{$post->comments()->count()}}</span></a>
                        <a href="#" class="card-link comment"><i class="fa fa-comment"></i> Comment</a>
                    </div>
                    <div class="comment-area mt-4">
                        <div class="card card-body">
                            <h6 class="card-title">Leave a comment</h6>
                            <form data-action="{{ route('comments.store') }}" method="POST" id="add-comment-form">
                                @csrf
                                <input type="hidden" value="{{$post->id}}" name="post_id">
                                <textarea type="text" name="comment" class="form-control" rows="3" required></textarea>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                        <div id="comment-container">
                        @foreach ($post->comments as $comment)
                            <div class="card card-body shadow-sm mt-3">
                                <div class="detail-area">
                                    <h6 class="user-name mb-1">{{$comment->user->name}}
                                        <small class="ms-3 text-primary">commented on : {{$comment->created_at->diffForHumans()}}</small>
                                    </h6>
                                    <p class="user-comment mb-1">
                                        {{$comment->comment}}
                                    </p>
                                </div>
                            </div>       
                        @endforeach
                        </div>
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
    $('#add-post-form').on('submit', function(event){
        event.preventDefault();

        var url = $(this).attr('data-action');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(res)
            {
                if(res.status == 200)
                {
                    alert(res.msg);
                    $('#add-post-form').trigger("reset");
                }
                else
                    alert(res.msg);
            },
            error: function(response) {
            }
        });
    });

});

$(document).ready(function(){
    $('#add-comment-form').on('submit', function(event){
        event.preventDefault();

        var url = $(this).attr('data-action');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(res)
            {
                if(res.status == 200)
                {
                    alert(res.msg);
                    var _html = '<div class="card card-body shadow-sm mt-3">\
                                    <div class="detail-area">\
                                        <h6 class="user-name mb-1"> '+res.data['name']+' <small class="ms-3 text-primary">commented on : '+res.data['created_at']+' </small>\
                                        </h6>\
                                        <p class="user-comment mb-1"> '+res.data['comment']+' </p>\
                                    </div>\
                                </div>';
                    $('#comment-container').prepend(_html);
                    $('#add-comment-form').trigger("reset");
                }
                else
                    alert(res.msg);
            },
            error: function(response) {
            }
        });
    });

});


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

$(document).ready(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        })
        $(".like").click(function(e){ 
        e.preventDefault();
        var postId = $('.postId').val();
        var isLike = e.target.previousElementSibling == null;
        /**Ajax code**/
        $.ajax({
            type: "POST",
            url:  "{{route('like')}}",
            data:{
                postId:postId,
                isLike:isLike,
            },
            success: function (res) {
                    if (res.status == 200) 
                    {
                        alert(res.msg);
                    }
                    else
                        alert(res.msg);
                }
            });
     });

 });
</script>
@endsection
