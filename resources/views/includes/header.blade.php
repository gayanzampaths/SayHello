<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="{{route('timeline')}}">Say Hello!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            @if(Auth::check())
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('timeline')}}">Timeline<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('profile')}}">Profile</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="nav-link" href="{{route('logout')}}">Logout</a></li>
                </ul>
            @endif
        </div>
    </nav>
</header>