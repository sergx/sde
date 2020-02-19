@extends('layouts.app')

@section('content')
<div class="container">

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">{{$category_type->name}}</h1>
      <p class="lead">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.</p>
    </div>
  </div>

  <nav class="nav nav-pills nav-justified mb-4">
    <a class="nav-link p-2" href="{{route('index')}}">Любая</a>
    @foreach ($category_types as $item)
    <a class="nav-link {{ $item->id == $category_type->id ? 'active': 'p-2' }}" href="{{$item->alias}}" style="white-space: nowrap;">{{$item->name}}</a>
    @endforeach
    <!--<a class="nav-link active" href="#">Active</a>-->
    <!--<a class="nav-link disabled" href="#">Disabled</a>-->
  </nav>

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
      @if ($productCategory->category_type->id == $category_type->id)
          <h2 class="mb-3 mt-3">{{$productCategory->name}}</h2>
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
      {{--
      @else

      <div class="card mb-3">
        <div class="card-header">
          <h5 class="card-title mb-0">{{$productCategory->name}} ({{$productCategory->category_type->name}})</h5>
        </div>
      </div>
      --}}

      @endif
      @endforeach
      @endif
    </div>
  </div>
  @endforeach
</div>
@endsection
