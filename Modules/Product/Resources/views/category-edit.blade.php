@extends('layouts.app')
@section('content')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('org.show', ['id' => $productCategory->org->id])}}">{{$productCategory->org->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$productCategory->name}}</li>
      </ol>
    </nav>
    <h1>Редактировать категорию товаров</h1>
    {!! Form::open(['route' => ['product_category.update', $productCategory->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{Form::hidden('_method', "PUT")}}
    <div class="form-group">
      {{Form::label('name','Название')}}
      {{Form::text('name', $productCategory->name, ['class' => 'form-control','placeholder' => 'Название'])}}
    </div>
    <div class="form-group">
      {{Form::label('description','Описание')}}
      {{Form::textarea('description', $productCategory->description, ['class' => 'form-control','placeholder' => 'Описание', 'id' => 'article-ckeditor'])}}
    </div>
    {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>
@endsection
