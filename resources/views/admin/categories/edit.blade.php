@extends('layouts.admin')

@section('header')
    <h1 class="h2">Редактировать запись</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
        </div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <form method="post" action="{{ route('admin.categories.store', ['categories' => $categories]) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="categories">Выбрать категории</label>
            <select class="form-control" name="categories[]" id="categories" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(in_array($category->id, $selectCategories)) selected @endif>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Наименование</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $categories->title }}">
        </div>
        <div class="form-group">
            <label for="status">Подкатегории</label>
            <select class="form-control" id="status" name="status">
                <option @if($categories->category === 'Internet') selected @endif>Интернет</option>
                <option @if($categories->category  === 'Culture') selected @endif>Культура</option>
                <option @if($categories->category  === 'Science and technology') selected @endif>Наука и технологии</option>
                <option @if($categories->category  === 'Sport') selected @endif>Спорт</option>
                <option @if($categories->category  === 'Politics') selected @endif>Политика</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Описание</label>
            <textarea class="form-control" id="description" name="description">{{ $categories->description }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float: right">Сохранить</button>
    </form>

@endsection
