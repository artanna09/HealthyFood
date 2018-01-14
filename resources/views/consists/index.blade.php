@extends ('layouts.app')

@section ('content')
    <h1> Consists </h1>
    @if(count($consists)>0)
        @foreach($consists as $consist)
            <div class="well">
                <h3> <a href="/consists/{{$consist->id}}">{{$consist->consist}}</a></h3>
            </div>
        @endforeach
        {{$consists->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection