@extends('layouts.admin')

@section('header')
    <h1 class="h2">Форма обратной связи</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2"></div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <form method="post" action="{{ route('admin.user.store') }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title">Введите имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            @error('name') <strong style="color: brown">{{ $message }}</strong>  @enderror
        </div>
        <div class="form-group">
            <label for="email">Номер телефона</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone}}">
            @error('phone') <strong style="color: brown">{{ $message }}</strong>  @enderror
        </div>
        <div class="form-group">
            <label for="email">Ведите Ваш Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->password }}">
            @error('email') <strong style="color: brown">{{ $message }}</strong>  @enderror
        </div>
        <div class="form-group">
            <label for="title">Информация о заказе</label>
            <textarea class="form-control" id="description" name="description">{{ $user->comments }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float: right">Сохранить</button>
    </form>
@endsection
