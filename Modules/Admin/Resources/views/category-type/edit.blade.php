@extends('layouts.app')

@section('content')
<div class="container">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.category-type.index')}}">Типы категорий</a></li>
      <li class="breadcrumb-item active" aria-current="page">Добавить категорию</li>
    </ol>
  </nav>

  <h1>Редактировать тип категории</h1>
  {!! Form::open(['route' => ['admin.category-type.update', $categoryType->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
  {{Form::hidden('_method', "PUT")}}
  <div class="form-group">
    <div class="form-row">
      <div class="col-5">
        {{Form::label('name','Название')}}
        {{Form::text('name', $categoryType->name, ['class' => 'form-control','placeholder' => 'Название'])}}
      </div>
      <div class="col">
        {{Form::label('alias','Alias (URL)')}}
        {{Form::text('alias', $categoryType->alias, ['class' => 'form-control','placeholder' => 'нижний регистр, только буквы (латинские)'])}}
      </div>
      <div class="col-2">
        {{Form::label('sort_order','Порядок сортировки')}}
        {{Form::number('sort_order', $categoryType->sort_order, ['class' => 'form-control'])}}
      </div>
    </div>
  </div>

  <div class="form-group">
    {{Form::label('image_icon','Иконка 128х128')}}
    <div class="form-row align-items-center">
      <div class="col">
        {{Form::file('image_icon')}}
      </div>
      @if($categoryType->image_icon)
      <div class="col">
        <img src="{{$categoryType->image_icon}}" alt="Ошибка при загрузки изображения">
      </div>
      @endif
    </div>
  </div>

  {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
</div>
@endsection
