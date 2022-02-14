<h2>Добро пожаловать на сайт, {{ Auth::user()->name }}</h2>
<br>
@if(Auth::user()->is_admin)
    <a href="{{ route('admin.index') }}" style="color:red">В админку</a>
    <br>
@endif

@if(Auth::user()->avatar)
    <img src="{{ Auth::user()->avatar }}" style="width:250px;">
@endif

<a href="{{ route('account.logout') }}">Выход</a>
