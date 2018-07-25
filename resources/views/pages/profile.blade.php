@extends('layouts.master')

@section('title')
    Profile
@endsection

@section('content')
    <main role="main" class="container" style="padding-top: 70px;">
        <h2>Profile</h2>
        <div class="container">
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
                        <div class="col-md-6 ">
                            <header><h3>My Posts</h3></header>
                            @foreach($uposts as $post)
                                <article class="post" data-postid="{{$post->id}}">
                                    <p>{{$post -> body}}</p>
                                    <div class="info">
                                        Posted by {{$post -> user->name}} on {{ $post -> created_at }}
                                    </div>
                                    <div class="interaction">
                                        <a href="#">Like</a>    |
                                        <a href="#">Dislike</a>
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
                </div>
            </div>
        </div>
    </main>
@endsection