@extends('layouts.master')

@section('title')
    TimeLine
@endsection

@section('content')
    <main role="main" class="container" style="padding-top: 70px;">
        <h2>TimeLine</h2>
        @include('includes.error-message')
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <header><h3>Whats on Your mind?</h3></header>
                <form action="{{route('post.create')}}" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Type Here!"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                    <input type="hidden" value="{{Session::token()}}" name="_token">
                </form>
            </div>
        </section>
        <section class="row posts">
            <div class="col-md-6 col-md-offset-3">
                <header><h3>Post Feed</h3></header>
                @foreach($posts as $post)
                    <article class="post" data-postid="{{$post->id}}">
                        <p>{{$post -> body}}</p>
                        <div class="info">
                            Posted by {{$post -> user->name}} on {{ $post -> created_at }}
                        </div>
                        <div class="likedetails">
                            <p>{{$likes = \App\Like::where([['post_id',$post->id],['like',1]])->get()->count()}} Likes | {{$likes = \App\Like::where([['post_id',$post->id],['like',0]])->get()->count()}} Dislikes</p>
                            <p></p>
                        </div>
                        <div class="interaction">
                            <a href="#" class="like">{{Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'}}</a>    |
                            <a href="#" class="like">{{Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'}}</a>
                            @if(Auth::user() == $post->user)
                                |
                                <a href="#" class="edit">Edit</a>    |
                                <a href="{{route('post.delete', ['post_id' => $post -> id])}}">Delete</a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="editpost">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="post-body">Edit the Post</label>
                                <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var token = '{{Session::token()}}';
            var urlEdit = '{{route('edit')}}';
            var urlLike = '{{route('post.like')}}';
        </script>

    </main>
@endsection