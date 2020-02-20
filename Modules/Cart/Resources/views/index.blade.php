@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Корзина</h1>

    @if (count($cart) >0)
      <div class="shadow-sm p-4 mb-5 mt-3 bg-white rounded">
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="border-top-0">Название</th>
              <th scope="col" class="border-top-0">Цена</th>
              <th scope="col" class="border-top-0">Кол-во</th>
              <th scope="col" class="border-top-0"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cart as $item)
              <tr>
                <td>{{$item->associatedModel->name}}</td>
                <td>{{$item->price}}</td>
                <td>

                  {!!Form::open(['route' => ['cart.more', $item->id], 'method' => 'POST', 'class' => 'form-ilnine'])!!}
                    {{Form::submit('-1',['class' => 'btn btn-outline-secondary btn-sm', 'formaction' => route('cart.less', $item->id)])}}
                    {{$item->quantity}}
                    {{Form::submit('+1',['class' => 'btn btn-outline-secondary btn-sm', 'formaction' => route('cart.more', $item->id)])}}
                  {!!Form::close()!!}
                </td>
                <td>
                  {!!Form::open(['route' => ['cart.remove_item', $item->id], 'method' => 'POST', 'class' => ''])!!}
                    {{Form::submit('Х',['class' => 'btn btn-danger btn-sm'])}}
                  {!!Form::close()!!}
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th scope="col"></th>
              <th scope="col">{{ $total }}</th>
              <th scope="col">{{ $totalQuantity }}</th>
              <th scope="col">
                {!!Form::open(['route' => 'cart.clear', 'method' => 'POST', 'class' => ''])!!}
                {{Form::hidden('_method','DELETE')}}
                  {{Form::submit('Очистить корзину',['class' => 'btn btn-danger btn-sm'])}}
                {!!Form::close()!!}
              </th>
            </tr>
          </tfoot>
        </table>
      </div>
      <h2 class="mb-3">Данные покупателя</h2>
      <div class="shadow-sm p-4 mb-5 bg-white rounded">
        {!!Form::open(['route' => 'order.create', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
        <div class="form-group">
          <div class="form-row align-items-center">
            <div class="col">
              {{Form::label('name','Представьтесь')}}
              {{Form::text('name', '', ['class' => 'form-control','placeholder' => 'Представьтесь'])}}
            </div>
            <div class="col">
              {{Form::label('phone','Телефон')}}
              {{Form::text('phone', '', ['class' => 'form-control','placeholder' => 'Телефон'])}}
            </div>
            <div class="col-2">
              {{Form::label('people_count','Кол-во персон')}}
              {{Form::number('people_count', '', ['class' => 'form-control','placeholder' => 'Кол-во персон'])}}
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row align-items-center">
            <div class="col">
              {{Form::label('phone','Адрес')}}
              <br>...
            </div>
            <div class="col">
              {{Form::label('phone','Время доставки')}}
              <br>...
            </div>
            <div class="col">
              {{Form::label('phone','Применить промокод')}}
              <br>...
            </div>
            <div class="col">
              {{Form::label('phone','Расплатиться баллами')}}
              <br>...
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Оформить заказ</button>
        {!!Form::close()!!}
      </div>
    @else
    <p>Корзина пуста</p>
    @endif
  </div>
  {{--
  <pre>
    {{print_r($cart)}}
  </pre>
  --}}
@endsection
