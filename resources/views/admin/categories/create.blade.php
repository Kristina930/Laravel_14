@extends('layouts.admin')

@section('header')
    <h1 class="h2">Список категорий</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
        </div>
    </div>
@endsection
@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif

    <form method="post" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Название новости</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="status">Подкатегории</label>
            <select class="form-control" id="status" name="status">
                <option @if(old('category') === 'Internet') selected @endif>Интернет</option>
                <option @if(old('category') === 'Culture') selected @endif>Культура</option>
                <option @if(old('category') === 'Science and technology') selected @endif>Наука и технологии</option>
                <option @if(old('category') === 'Sport') selected @endif>Спорт</option>
                <option @if(old('category') === 'Politics') selected @endif>Политика</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Описание</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float: right">Сохранить</button>
    </form>

@endsection
