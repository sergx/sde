@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Спасибо за заказ!</h1>
        <p class="lead">Номер вашего заказа — <strong>{{$order_id ?? ''}}</strong></p>
      </div>
    </div>
  </div>
@endsection
