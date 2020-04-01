@if($errors->any())
    @foreach($errors->all() as $err)
        <div class="alert alert-danger">{{$err}}</div>
        @endforeach
@endif
