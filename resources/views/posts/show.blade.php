@extends ('layouts.app')

@section ('content')
<a href="/posts" class="btn btn-default">Go Back</a>
    <h1> {{$post->title}} </h1>
    <div class="row">
        <div class="col-md-4">
            <img style="width:300px" src="/storage/cover_images/{{$post->cover_image}}">
        </div>
        <div class="col-md-8">
            {!!$post->body!!}
            {{$post->method->method}}
            {{$post->consist->consist}}
        </div>
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id)
    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST','class' =>'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
    {!!Form::close()!!}
    @endif
    @endif
    @endsection