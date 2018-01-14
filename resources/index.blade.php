@extends ('layouts.app')

@section ('content')
    <h1> Posts </h1>
    @if (count($posts)>0)
    @foreach ($posts for $post)
    <div class = "well">
        <h3>{{$post->tile}}</h3>
    </div>
    @endforeach
    @else 
    <p> No posts found </p>
    @endif
@endsection