@extends('layouts.admin')
@section('header')
    <h1 class="h2">Изменение учетных данных</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
        </div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <form method="post" action="{{ route('admin.profile.update') }}">
        @csrf
        @include('inc.message')
        <div class="form-group">
            <label for="title">Введите имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="email">Ведите Ваш Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="email">Номер телефона</label>
            <input type="telephone" class="form-control" id="telephone" name="telephone" value="{{ $user->phone }}">
        </div>
        <div class="form-group">
            <label for="email">Номер телефона</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Текущий пароль" value="{{ $user->password }}">
        </div>
        <div class="form-group">
            <label for="email">Номер телефона</label>
            <input type="newPassword" class="form-control" id="newPassword" name="newPassword" placeholder="Новый пароль">
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float: right">Изменить</button>
    </form>
@endsection
