@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Типы еды</h5>
          <a class="btn btn-primary btn-sm" href="{{route('admin.category-type.create')}}" role="button">Добавить</a>
        </div>
        <div class="card-body">
          @if (count($categoryTypes) > 0)
          <ul class="list-group list-group-flush">
            @foreach ($categoryTypes as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <a href="{{route('admin.category-type.edit', ['id' => $item->id])}}">{{$item->name}}</a>
              <img src="{{$item->image_icon}}" alt="" style="height: 32px">
            </li>
            @endforeach
          </ul>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
