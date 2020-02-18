@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Заведения</h2>

  @foreach ($orgs as $org)
  <div class="card mb-5">
    <div class="card-header">
      <h5 class="card-title mb-0">{{$org->name}}</h5>
    </div>
    <div class="card-body">
      <p class="card-text"><strong>Адрес:</strong> {{$org->address}}</p>

      @if ($org->description)
      <div class="mb-3">
        <p>{!!$org->description!!}</p>
      </div>
      @endif

      @if(count($org->productCategories) > 0)
      @foreach ($org->productCategories as $productCategory)
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="card-title mb-0">{{$productCategory->name}}</h5>
        </div>
        <div class="card-body">

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

        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>
  @endforeach
</div>
@endsection
