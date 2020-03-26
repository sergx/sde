@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col col-9">
      <div class="jumbotron jumbotron-fluid mb-2">
        <div class="container">
          <h1 class="display-4">{{$org->name}}</h1>
          <p class="lead"><strong>Адрес:</strong> {{$org->address}}</p>
          @if ($org->description)
          <div class="mb-3">
            <p>{!!$org->description!!}</p>
          </div>
          @endif
        </div>
      </div>

      <div class="mb-4" style="color: #919399;">
        Заказ от 350 руб * Доставка 69 руб * Бесплатная доставка от 800 руб
      </div>

      <nav class="nav-pills nav-justified mb-4">
        @foreach ($category_types as $alias => $name)
          <a class="btn btn-outline-primary" href="place/{{$org->id}}#{{$alias}}" data-typeid="{{$alias}}" style="white-space: nowrap;">{{$name}}</a>
        @endforeach
      </nav>

      @if(count($org->productCategories) > 0)
        @foreach ($org->productCategories as $productCategory)
          <h2 class="mb-3 mt-3" id="{{$productCategory->category_type->alias}}">{{$productCategory->name}}</h2>
          @if ($productCategory->description)
          <div class="mb-3">
            <p>{!!$productCategory->description!!}</p>
          </div>
          @endif

          @if(count($productCategory->products) > 0)
          <div class="row">
            @foreach ($productCategory->products->sortBy('sort_order') as $product)
              <div class="col-4 mb-3">
                <div class="product_card">
                  <div class="image" style="background-image:url('{{$product->main_image}}')"></div>
                  <div class="title">
                    {{$product->name}}
                  </div>
                  <div class="price">
                    <div class="value">
                      {{$product->price}} руб
                    </div>
                    {!!Form::open(['route' => 'cart.add', 'method' => 'POST', 'class' => ''])!!}
                    {{Form::hidden('_method','PUT')}}
                    {{Form::hidden('product_id', $product->id)}}
                      {{Form::submit('В корзину',['class' => 'btn btn-success btn-sm'])}}
                    {!!Form::close()!!}
                  </div>

                </div>
                {{--
                <div class="card w-100 h-100">
                  <div class="card-body">
                    <div class="product_image"></div>
                  </div>
                </div>
                --}}
              </div>
            @endforeach
          </div>
          @endif
        @endforeach
      @endif

    </div>
    <div class="col col-3">
      <div class="sticky-top mincart_wr" style="height: 80vh;">
        <div class="card h-100">
          <div class="card-body">
            <h2>Корзина</h2>
            <div class="mincart_content">
              @if (count($cart) > 0)
              <table>
                @foreach ($cart as $item)
                  <tr>
                    <td>
                      <span class="name">{{$item->associatedModel->name}}</span>
                    </td>
                    <td>
                      {!!Form::open(['route' => ['cart.more', $item->id], 'method' => 'POST', 'class' => 'form-ilnine'])!!}
                        {{Form::submit('-1',['class' => 'btn btn-outline-secondary btn-sm', 'formaction' => route('cart.less', $item->id)])}}
                        {{$item->quantity}}
                        {{Form::submit('+1',['class' => 'btn btn-outline-secondary btn-sm', 'formaction' => route('cart.more', $item->id)])}}
                      {!!Form::close()!!}
                    </td>
                    <td>{{$item->price}} р.</td>
                  </tr>
                @endforeach
              </table>
              <div class="tips">
                <div class="item tip_error">
                  ?? руб до минимальной суммы
                </div>
              </div>

              <a href="cart" class="to_order btn btn-success">
                <span>Заказать</span> <span class="total">{{$cart_total}} р.</span>
              </a>
              @else
              <div class="empty">
                <p class=""><small>Корзина пуста</small></p>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
