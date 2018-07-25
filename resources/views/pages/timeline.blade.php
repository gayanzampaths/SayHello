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
                <form action="post.create" method="post">
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
                    <article class="post">
                        <p>{{$post -> body}}</p>
                        <div class="info">
                            Posted by {{$post -> user->name}} on {{ $post -> created_at }}
                        </div>
                        <div class="interaction">
                            <a href="#">Like</a>
                            <a href="#">Dislike</a>
                            <a href="#">Edit</a>
                            <a href="{{route('post.delete', ['post_id' => $post -> id])}}">Delete</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
@endsection