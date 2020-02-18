@extends('layouts.app')
@section('content')
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('org.show', ['id' => $product->product_category->org->id])}}">{{$product->product_category->org->name}}</a></li>
        <li class="breadcrumb-item">{{$product->product_category->name}}</li>
        <li class="breadcrumb-item active" aria-current="page">Редактировать товар</li>
      </ol>
    </nav>
    <h1>Редактировать товар</h1>
    {!! Form::open(['route' => ['product.update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{Form::hidden('_method', "PUT")}}
    <div class="form-group">
      {{Form::label('name','Название')}}
      {{Form::text('name', $product->name, ['class' => 'form-control','placeholder' => 'Название'])}}
    </div>
    <div class="form-group">
      <div class="form-row align-items-center">
        <div class="col">
          {{Form::label('price','Цена')}}
          {{Form::number('price', $product->price, ['class' => 'form-control','placeholder' => 'Цена'])}}
        </div>
        <div class="col">
          {{Form::label('action_price','Акционная цена')}}
          {{Form::number('action_price', $product->action_price, ['class' => 'form-control','placeholder' => 'Акционная цена'])}}
        </div>
        <div class="col-auto">
          <div class="form-check">
            {{Form::label('action_price','Популярный')}}
            <div>
              {{Form::checkbox('is_popular', '1', $product->is_popular)}}
              {{Form::label('action_price','Да')}}
            </div>
          </div>
        </div>
        <div class="col-auto">
          <div class="form-check">
            {{Form::label('action_price','Новинка')}}
            <div>
              {{Form::checkbox('is_new', '1', $product->is_new)}}
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
          {{Form::text('url', $product->url, ['class' => 'form-control'])}}
        </div>
        <div class="col">
          {{Form::label('sort_order','Порядок сортировки')}}
          {{Form::number('sort_order', $product->sort_order, ['class' => 'form-control'])}}
        </div>
      </div>
    </div>
    {{--
    <div class="form-group">
      {{Form::label('description','Описание')}}
      {{Form::textarea('description', $product->description, ['class' => 'form-control','placeholder' => 'Описание', 'id' => 'wysiwyg_editor'])}}
    </div>
    --}}
    <div class="form-group">
      <div class="form-group{!! $errors->has('description') ? ' has-error' : '' !!}">
      {!! Form::label('description', 'Body' . ':', ['class' => 'control-label']) !!}
      {!! Form::textarea('description', NULL, ['class' => 'form-control', 'id' => 'wysiwyg_editor']) !!}
      @if ($errors->has('description'))
      <span class="help-block">
        <strong>{!! $errors->first('description') !!}</strong>
      </span>
      @endif
      </div>
      </div>
    <div class="form-group">
      {{Form::label('main_image','Основное изображение')}}
      <div class="form-row align-items-center">
        <div class="col">
          {{Form::file('main_image')}}
        </div>
        @if($product->main_image)
        <div class="col">
          <img src="/storage/main_image/{{$product->main_image}}" alt="" style="max-width:400px;mah-heigh:400px">
        </div>
        @endif
      </div>
    </div>
    {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>
  <script>
  $(document).ready(function() {
    $('#wysiwyg_editor').summernote({
      height:300,
      // popover: {
      //   image: [],
      //   link: [],
      //   air: [],
      // }
      dialogsInBody: true,
      callbacks:{
        onInit:function(){
        $('body > .note-popover').hide();
        }
      },
    });
  });
  </script>
@endsection
