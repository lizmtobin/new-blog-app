@extends('layout')
@section('content')
<article>
    <h1>
        <a href="/posts/<?= $post->slug ?>">
            {{$post->title }}
        </a>
    </h1>
    <div>
        {!! $post->body !!}
        <!-- this is the way to escape html from body() function -->
    </div>
</article>
@endsection