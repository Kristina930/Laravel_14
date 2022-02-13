@extends('layouts.admin')

@section('header')
    <h1 class="h2">Форма обратной связи</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2"></div>
    </div>
@endsection
@section('content')
    <form method="post" action="{{ route('admin.user.store') }}">
        @csrf
        @include('inc.message')
        <div class="form-group">
            <label for="title">Введите имя</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="email">Номер телефона</label>
            <input type="telephone" class="form-control" id="telephone" name="telephone" value="{{ old('phone_numbers') }}">
        </div>
        <div class="form-group">
            <label for="email">Ведите Ваш Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="title">Информация о заказе</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float: right">Сохранить</button>
    </form>
@endsection

