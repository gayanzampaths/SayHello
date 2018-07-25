@extends('layouts.master')

@section('title')
    Edit Profile
@endsection

@section('content')
    <main role="main" class="container" style="padding-top: 70px;">
        <h2>Edit Profile</h2>
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <header><h3>{{$user->name}}, Change Your Profile Details</h3></header>
                <form action="{{route('profile.save')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Name</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" disabled>
                    </div>

                    @if(Storage::disk('local')->has($user->name.'_'.$user->id.'.jpg'))
                        <div class="col-md-6 col-md-offset-3">
                            <img src="{{ route('profile.image', ['filename' => $user->name . '_' . $user->id . '.jpg']) }}" alt="" class="img-responsive rounded-circle">
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="image">Image (upload in .JPG format)</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Account Details</button>
                    <input type="hidden" value="{{Session::token()}}" name="_token">
                </form>
            </div>
        </section>
    </main>
@endsection