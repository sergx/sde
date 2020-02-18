@extends('layouts.app')
@section('content')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Добавить заведение</li>
      </ol>
    </nav>
    <h1>Добавить заведение</h1>
    {!! Form::open(['route' => 'org.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
      {{Form::label('name','Название')}}
      {{Form::text('name', '', ['class' => 'form-control','placeholder' => 'Название'])}}
    </div>
    <div class="form-group">
      {{Form::label('address','Адрес')}}
      {{Form::text('address', '', ['class' => 'form-control','placeholder' => 'Адрес'])}}
    </div>
    <div class="form-group">
      {{Form::label('work_time','Часы работы')}}
      {{Form::text('work_time', '', ['class' => 'form-control','placeholder' => 'Часы работы'])}}
    </div>
    <div class="form-group">
      {{Form::label('description','Описание')}}
      {{Form::textarea('description', 'Описание <strong>по-умолчанию!</strong>', ['class' => 'form-control','placeholder' => 'Описание', 'id' => 'article-ckeditor'])}}
    </div>
    <!--
    <div class="form-group">
      {{Form::file('images')}}
    </div>
    -->
    {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>
@endsection
