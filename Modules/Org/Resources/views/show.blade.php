@extends('layouts.app')
@section('content')
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$org->name}}</li>
    </ol>
  </nav>
  
  <div class="card mb-5">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">{{$org->name}}</h5>
        <a href="{{route('org.orders', $org->id)}}" class="btn btn-primary btn-sm mr-2 ml-auto">Заказы</a>
        <a href="{{route('org.edit', ['id' => $org->id])}}" class="btn btn-primary btn-sm">Редактировать</a>
      </div>
    </div>
    <div class="card-body">
      <p class="card-text">{{$org->address}}</p>
      <div class="mb-3">
        <p>{!!$org->description!!}</p>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between mb-3">
    <h2 class="mb-0">Акции</h2>
    <a href="{{route('action.create', ['org_id' => $org->id])}}" class="btn btn-success pull-right">Добавить</a>
  </div>

  <div class="d-flex justify-content-between mb-3">
    <h2 class="mb-0">Категории товаров</h2>
    <a href="{{route('product_category.create', ['org_id' => $org->id])}}" class="btn btn-success pull-right">Добавить</a>
  </div>
  @if(count($org->productCategories) > 0)
    @foreach ($org->productCategories as $item)
    <div class="card mb-3">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">{{$item->name}}</h5>
          <div class="btn-toolbar">
            <a href="{{route('product.create', ['product_category_id' => $item->id])}}" class="btn btn-success btn-sm mr-1">Добавить товар</a>
            <a href="{{route('product_category.edit', ['id' => $item->id])}}" class="btn btn-primary btn-sm">Редактировать категорию</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <p class="card-text">{!!$item->description!!}</p>
        @if(count($item->products) > 0)
        <div class="row">
          @foreach ($item->products->sortBy('sort_order') as $product)
              <div class="col-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$product->price}} руб</h6>
                    <p class="card-text">{{$product->description}}</p>
                    <p class="card-text text-muted">
                      Покупок: хх
                    </p>
                    <a href="{{route('product.edit', $product)}}" class="card-link">Редактировать</a>

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
@endsection
