@extends('layouts.admin')

@section('header')
    <h1 class="h2">Форма заказа</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.order.create') }}" type="button" class="btn btn-sm btn-outline-secondary">
                Оформить заказ</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="table-responsive">
        Заказ
    </div>
@endsection
