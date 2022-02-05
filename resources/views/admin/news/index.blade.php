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
               <!-- Не работает ссылка на редактирование, не знаю что уже делать-->
            <td><a href="<td><a href="{{ route('admin.news.edit', ['news' => $news]) }}">Ред.</a> &nbsp;
                <a href="javascript:;" class="delete" rel="{{ $news->id }}">Уд.</a></td>
           @endforeach
           </tbody>
       </table>
      <div style="margin: 20px">{{ $newsList->links() }}</div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            const el = document.querySelectorAll(".delete");
            el.forEach(function (e, k) {
                e.addEventListener('click', function () {
                    const id = this.getAttribute('rel');
                    if (confirm('Подтвердить удаление новости с #ID ${id} ?')) {
                        send('/admin/news/' + id).then(() => {
                            location.reload();
                        })
                    }
                });
            });
        });

        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                        'X-CSRF-TOKEN': document.querySelector(('meta[name="csrf-token"]') .getAttribute('content'))
                    }
                });

            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
