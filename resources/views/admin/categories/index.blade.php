@extends('layouts.admin')

@section('header')
    <h1 class="h2">Список категорий</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.categories.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить категорию</a>
        </div>
    </div>
@endsection
@section('content')
        @include('inc.message')
        <table class="table-bordered">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Заголовок</th>
                <th>Категории</th>
                <th>Дата добавления</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                </tr>
                <!-- Не работает ссылка на редактирование, не знаю что уже делать-->
                <td><a href="<td><a href="{{ route('admin.categories.edit', ['categories' => $category]) }}">Ред.</a> &nbsp;<a href="">Уд.</a></td>
            @endforeach
            </tbody>
        </table>
        <div style="margin: 20px">{{ $categories->links() }}</div>
    </div>

@endsection


