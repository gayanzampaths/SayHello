@if(count($errors)>0)
    <div class="row">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <ul>
                    @foreach($errors -> all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
@if(Session::has('message'))
    <div class="row">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                {{Session::get('message')}}
            </div>
        </div>
    </div>
@endif