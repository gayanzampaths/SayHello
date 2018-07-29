@extends('layouts.master')

@section('title')
    Profile
@endsection

@section('content')
    <div class="container" style="padding-top: 70px; margin: 10px;">
        <h2>Profile</h2>
            <div class="row">
                <div class="col">
                    <section class="row new-post">
                        <div class="col-md-6 col-md-offset-3">
                            <header><h3>Profile Details</h3></header>
                                @if(Storage::disk('local')->has($user->name.'_'.$user->id.'.jpg'))
                                    <div class="col-md-6 col-md-offset-3">
                                        <img src="{{ route('profile.image', ['filename' => $user->name . '_' . $user->id . '.jpg']) }}" alt="" class="img-responsive rounded-circle">
                                    </div>
                                @endif
                                <br>
                                <div class="form-group">
                                    <h5>Name : {{$user->name}}</h5>
                                </div>
                                <div class="form-group">
                                    <h5>Email : {{$user->email}}</h5>
                                </div>
                                <a class="btn btn-primary" href="{{route('profile.edit')}}" role="button">Edit Profile</a>
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col">
                    <section class="row posts">
                        <div class="col-md-12">
                            <header><h3>My Posts</h3></header>
                            @foreach($uposts as $post)
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
            </div>
        </div>
    </div>
@endsection