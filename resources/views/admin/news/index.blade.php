@extends('layouts.admin')

@section('header')
    <h1 class="h2">Список новостей</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.news.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить новость</a>
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
                    <th>Заголовок</th>
                    <th>Категории</th>
                    <th>Автор</th>
                    <th>Статус</th>
                    <th>Дата добавления</th>
                    <th>Действия</th>
                </tr>
           </thead>
           <tbody>
           @foreach($newsList as $news)
               <tr>
                    <td>{{ $news->id }}</td>
                   <td>{{ $news->title }}</td>
                   <td>
                       @foreach($news->categories as $category)
                           {{ $category->title }},
                       @endforeach

                   </td>
                   <td>{{ $news->author }}</td>
                   <td>{{ $news->status }}</td>
                   <td>{{ $news->created_at }}</td>
               </tr>
            <td><a href="{{--почему-то выдает ошибку данный роут, в БД все сохраняется, но в браузере ошибка  {{ route('admin.news.edit') }}--}}">Ред.</a> &nbsp; <a href="">Уд.</a></td>
           @endforeach
           </tbody>
       </table>
      <div style="margin: 20px">{{ $newsList->links() }}</div>
    </div>
@endsection

