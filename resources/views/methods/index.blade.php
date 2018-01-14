@extends ('layouts.app')

@section ('content')
    <h1> Methods </h1>
    @if(count($methods)>0)
        @foreach($methods as $method)
            <div class="well">
                <h3> <a href="/posts/{{$method->id}}">{{$method->method}}</a></h3>
            </div>
        @endforeach
        {{$methods->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection