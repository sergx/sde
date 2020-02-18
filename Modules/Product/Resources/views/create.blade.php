@extends('layouts.app')
@section('content')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('org.show', ['id' => $product_category->org->id])}}">{{$product_category->org->name}}</a></li>
        <li class="breadcrumb-item">{{$product_category->name}}</li>
        <li class="breadcrumb-item active" aria-current="page">Добавить товар</li>
      </ol>
    </nav>
    <h1>Добавить товар</h1>
    {!! Form::open(['route' => ['product.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{Form::hidden('product_category_id', $product_category->id)}}
    {{Form::hidden('org_id', $product_category->org->id)}}
    <div class="form-group">
      {{Form::label('name','Название')}}
      {{Form::text('name', '', ['class' => 'form-control','placeholder' => 'Название'])}}
    </div>
    <div class="form-group">
      <div class="form-row align-items-center">
        <div class="col">
          {{Form::label('price','Цена')}}
          {{Form::number('price', '', ['class' => 'form-control','placeholder' => 'Цена'])}}
        </div>
        <div class="col">
          {{Form::label('action_price','Акционная цена')}}
          {{Form::number('action_price', '', ['class' => 'form-control','placeholder' => 'Акционная цена'])}}
        </div>
        <div class="col-auto">
          <div class="form-check">
            {{Form::label('action_price','Популярный')}}
            <div>
              {{Form::checkbox('is_popular', '1', false)}}
              {{Form::label('action_price','Да')}}
            </div>
          </div>
        </div>
        <div class="col-auto">
          <div class="form-check">
            {{Form::label('action_price','Новинка')}}
            <div>
              {{Form::checkbox('is_new', '1', false)}}
              {{Form::label('action_price','Да')}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="form-row">
        <div class="col-8">
          {{Form::label('url','URL')}}
          {{Form::text('url', '', ['class' => 'form-control'])}}
        </div>
        <div class="col">
          {{Form::label('sort_order','Порядок сортировки')}}
          {{Form::number('sort_order', '', ['class' => 'form-control'])}}
        </div>
      </div>
    </div>
    <div class="form-group">
      {{Form::label('description','Описание')}}
      {{Form::textarea('description', 'Описание по-умолчанию!', ['class' => 'form-control','placeholder' => 'Описание', 'id' => 'article-ckeditor'])}}
    </div>
    <div class="form-group">
      {{Form::label('main_image','Основное изображение')}}
      <div>
        {{Form::file('main_image')}}
      </div>
    </div>
    {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>
@endsection
