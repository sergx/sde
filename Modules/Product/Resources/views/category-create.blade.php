@extends('layouts.app')
@section('content')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('org.show', ['id' => $org->id])}}">{{$org->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Добавить категорию товаров</li>
      </ol>
    </nav>
    <h1>Добавить категорию товаров</h1>
    {!! Form::open(['route' => 'product_category.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{Form::hidden('org_id', $org->id)}}
    <div class="form-group">
      {{Form::label('name','Название')}}
      {{Form::text('name', '', ['class' => 'form-control','placeholder' => 'Название'])}}
    </div>
    <div class="form-group">
      {{Form::label('description','Описание')}}
      {{Form::textarea('description', 'Описание по-умолчанию!', ['class' => 'form-control','placeholder' => 'Описание', 'id' => 'article-ckeditor'])}}
    </div>
    {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>
@endsection
