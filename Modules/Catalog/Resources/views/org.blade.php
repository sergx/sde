@extends('layouts.app')

@section('content')
<div class="container">

  <div class="jumbotron jumbotron-fluid">
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
              <div class="col-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$product->price}} руб</h6>
                    {!!Form::open(['route' => 'cart.add', 'method' => 'POST', 'class' => ''])!!}
                    {{Form::hidden('_method','PUT')}}
                    {{Form::hidden('product_id', $product->id)}}
                      {{Form::submit('В корзину',['class' => 'btn btn-success btn-sm'])}}
                    {!!Form::close()!!}
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          @endif
        @endforeach
      @endif
</div>
@endsection
