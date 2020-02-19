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
      <div class="form-row">
        <div class="col-8">
          {{Form::label('name','Название')}}
          {{Form::text('name', $productCategory->name, ['class' => 'form-control','placeholder' => 'Название'])}}
        </div>
        <div class="col">
          {{Form::label('category_type_id','Тип категории')}}
          <select class="form-control" id="category_type_id">
            <option value="" disabled>Тип категории</option>
            @foreach ($category_types as $item)
              <option value="{{$item->id}}" {{$productCategory->category_type_id == $item->id ? 'selected': ''}}>{{$item->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      {{Form::label('description','Описание')}}
      {{Form::textarea('description', $productCategory->description, ['class' => 'form-control','placeholder' => 'Описание', 'id' => 'article-ckeditor'])}}
    </div>
    {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>
@endsection
