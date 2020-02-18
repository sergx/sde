@extends('layouts.app')
@section('content')
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{route('org.show', $org)}}">{{$org->name}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Заказы</li>
    </ol>
  </nav>
  <h1>{{$org->name}} — Заказы</h1>
  @if (count($orders))
    <div class="shadow-sm p-4 mb-5 mt-3 bg-white rounded">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Товары</th>
            <th scope="col">Контакты</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Создан</th>
            <th scope="col">Статус</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
          <tr>
            <th scope="row">{{$order->id}}</th>
            <td>
              <ul>
              @foreach ($order->products as $product)
                <li>{{$product->name}}</li>
              @endforeach
              </ul>
            </td>
            <td>
              <ul>
                @if ($order->contact->name)
                  <li>{{$order->contact->name}}</li>
                @endif
                @if ($order->contact->phone)
                  <li>{{$order->contact->phone}}</li>
                @endif
                @if ($order->contact->email)
                  <li>{{$order->contact->email}}</li>
                @endif
                @if ($order->contact->address)
                  <li>{{$order->contact->address}}</li>
                @endif
              </ul>
            </td>
            <td>{{$order->products_price}} <span>+ {{$order->delivery_price}}</span> = <strong>{{$order->products_price + $order->delivery_price}} <small>руб.</small></strong></td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->status}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    <p>Заказов нет</p>
  @endif
</div>
@endsection
