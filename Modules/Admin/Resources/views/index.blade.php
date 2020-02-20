@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Административные функции</div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{route('admin.category-type.index')}}">Типы категорий</a>
            </li>
            <li class="list-group-item">
                <a href="{{route('admin.order')}}">Заказы</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
