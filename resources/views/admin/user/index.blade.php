@extends('layouts.admin')

@section('header')
    <h1 class="h2">Обратная связь</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.user.create') }}" type="button" class="btn btn-sm btn-outline-secondary">
                Добавить отзыв</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="table-responsive">
        @include('inc.message')
        <table class="table-bordered">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Номер телефона</th>
                <th>Комментарии/отзывы</th>
                <th>Дата добавления</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->phone_numbers }}</td>
                    <td>{{ $user->email }}</td>
                    <!-- Не работает ссылка на редактирование, не знаю что уже делать-->
                    <td><a href="<td><a href="{{ route('admin.user.edit', ['user' => $user]) }}">Ред.</a> &nbsp;<a href="">Уд.</a></td>
            @endforeach
            </tbody>
        </table>
        <div style="margin: 20px">{{ $newsList->links() }}</div>
    </div>
@endsection
