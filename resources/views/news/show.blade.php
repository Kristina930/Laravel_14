@extends('layouts.main')
@section('content')
<div>
    <h2><{{ $news->title }}</h2>
    <h4>Категории:
        @foreach($news->categories as $category)
            {{ $category->title }},

        @endforeach


    </h4>
    <p>Автор: {{ $news->author }}&nbsp; Дата добавления: {{ $news->created_at }}</p>


    <p>{!!  $news->description !!}</p>
</div><hr>
@endsection
