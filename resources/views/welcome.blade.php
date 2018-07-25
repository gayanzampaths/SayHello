@extends('.layouts.master')

@section('title')
    SayHello
@endsection

@section('content')
    <main role="main" class="container" style="padding-top: 70px;">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h3>Already have a account</h3>
                <form action="#" method="post">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" id="loginEmail" placeholder="Email Address">
                        </div>
                        <div class="col">
                            <input type="password" class="form-control" id="loginPwd" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">SignIn</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <img class="" src="{{URL::asset('/images/sayHello.png')}}" alt="Say Hello!" style="padding-top: 50px; max-width: 350px;">
                <br>
                <h2>Welcome to Say Hello!</h2>
            </div>
            <div class="col">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h3>SignUp for Say Hello!</h3>
                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Your Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">SignUp</button>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection