@extends('layouts.app')
@section('content')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('org.show', ['id' => $org->id])}}">{{$org->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Добавить акцию</li>
      </ol>
    </nav>
    <h1>Добавить акцию</h1>
    {!! Form::open(['route' => ['action.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{Form::hidden('org_id', $org->id)}}
    <div class="form-group">
      <div class="form-row align-items-center">
        <div class="col">
          {{Form::label('name','Название акции')}}
          {{Form::text('name', '', ['class' => 'form-control','placeholder' => 'Название'])}}
        </div>
        <div class="col">
          {{Form::label('action_key','Тип акции')}}
          <select name="action_key" class="form-control" id="action_key">
            <option value="" disabled>Тип акции</option>
            <option value="some_of_kind_for_fixed_price">2/3/4/... по фиксированной цене</option>
            <option value="gift_from_some_sum" disabled>Подарок при покупке от ___ руб</option>

          </select>
        </div>
      </div>
    </div>
    <div class="text-center">
      Остальные настройки появятся после сохранения
    </div>
    {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>
@endsection
