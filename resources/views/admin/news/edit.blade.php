@extends('layouts.admin')
@section('header')
    <h1 class="h2">Редактировать запись</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2"></div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="categories">Выбрать категории</label>
            <select class="form-control" name="categories[]" id="categories"  multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            @if($category->id === $news->category_id) selected @endif>{{ $category->title }}</option>
                @endforeach
                    @error('title') <strong style="color:red;">{{ $message }}</strong>  @enderror
            </select>
        </div>
        <div class="form-group">
            <label for="title">Наименование</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}">
            @error('title') <strong style="color:red;">{{ $message }}</strong>  @enderror
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" class="form-control" id="author" name="author"  value="{{ $news->author }}">
            @error('author') <strong style="color:red;">{{ $message }}</strong>  @enderror
        </div>
        <div class="form-group">
            <label for="image">Загрузить изображение</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" id="status" class="form-control">
                <option @if($news->status === 'DRAFT') selected @endif>DRAFT</option>
                <option @if($news->status === 'ACTIVE') selected @endif>ACTIVE</option>
                <option @if($news->status === 'BLOCKED') selected @endif>BLOCKED</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Описание</label>
            <textarea class="form-control" name="description" id="description">{!! $news->description !!}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float:right;">Сохранить</button>
    </form>
@endsection

@push('js')
    <script>
        ClassicEditor
            .create( document.querySelector('#description'))
            .catch( error => {
                console.error( error );
            } );
    </script>

@endpush
