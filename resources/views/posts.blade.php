@extends('layout')
@section('content')
@foreach ($posts as $post)
<article class=" {{$loop->even ? 'foof' : 'bar'}}">
    <h1>
        <a href="/posts/{{$post->id}}">
            {{ $post->title }}
        </a>
    </h1>
    <div>
        {{$post->excerpt }}
    </div>
</article>
@endforeach
@endsection