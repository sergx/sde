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
    <h1>Редактировать акцию</h1>
    {!! Form::open(['route' => ['action.update', $action->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{Form::hidden('org_id', $org->id)}}
    {{Form::hidden('_method', 'PUT')}}
    <div class="form-group">
      <div class="form-row align-items-center">
        <div class="col">
          {{Form::label('name','Название акции')}}
          {{Form::text('name', $action->name, ['class' => 'form-control','placeholder' => 'Название'])}}
        </div>
        <div class="col">
          {{Form::label('action_key','Тип акции')}}
          <select class="form-control" id="action_key" name="action_key" disabled>
            <option value="some_of_kind_for_fixed_price"
              @if ($action->action_key == "some_of_kind_for_fixed_price") selected="selected" @endif
            >2/3/4/... по фиксированной цене</option>
            <option value="gift_from_some_sum"
              @if ($action->action_key == "gift_from_some_sum") selected="selected" @endif
            >Подарок при покупке от ___ руб</option>
          </select>
        </div>
      </div>
    </div>
    @if ($action->action_key == "some_of_kind_for_fixed_price")
      <div class="description">
        <strong>Описание акции</strong><br>
        <p>Некое кол-во товара будут стоить фиксированную цену, например, 3 пиццы за 759 рублей</p>
        <p>Название акции должно быть максимально понятным, например "3 пирога за 800 рублей", или "4 пиццы 25см за 950 рублей".</p>
        <p>Предпочтительно, чтобы товары для акции были все, или большенство, товаров из одной категории. Например все горячние роллы, или все пиццы среднего размера.</p>
        <p>Если вы хотите сделать набор из каких-то конкреттных блюд, воспользуйтесь типом акции "Набор".</p>
      </div>
      <div class="form-group">
        <div class="form-row align-items-center">
          <div class="col">
            {{Form::label('product_count','Кол-во')}}
            {{Form::number('product_count', $action->product_count, ['class' => 'form-control','placeholder' => 'Кол-во'])}}
          </div>
          <div class="col">
            {{Form::label('fixed_price','Фиксированная цена')}}
            {{Form::number('fixed_price', $action->fixed_price, ['class' => 'form-control','placeholder' => 'Фиксированная цена'])}}
          </div>
        </div>

        <div class="form-row align-items-center">
          <div class="col">
            {{Form::label('active_days', 'Активные даты')}}
            {{Form::text('active_days', $action->active_days, ['class' => 'form-control','placeholder' => 'Активные даты'])}}
            <p>Если даты не заполнены, то акция начинает действовать с нынешнего момента</p>
          </div>
        </div>

        <div class="form-row align-items-center mt-3">
          <div class="col">
            <h3>Товары, участвующие в акции</h3>
            @if(count($org->productCategories) > 0)
              @foreach ($org->productCategories as $item)
                @if(count($item->products) > 0)
                  <h4>{{$item->name}}</h4>
                  <ul>
                    @foreach ($item->products->sortBy('sort_order') as $product)
                    <li>
                      {{Form::checkbox('product_ids[]', $product->id, ($action->product_ids && in_array($product->id, $action->product_ids)? true : false ), ['id' => 'product_id_'.$product->id])}}
                      {{Form::label('product_id_'.$product->id, $product->price ." руб. — ". $product->name)}}
                    </li>
                    @endforeach
                  </ul>
                @endif
              @endforeach
            @endif

          </div>
        </div>
      </div>
      <div class="form-group">
        {{Form::label('image_sm', 'Малое изображение акции')}}
        <div>
          {{Form::file('image_sm')}}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('image_md', 'Среднее изображение акции')}}
        <div>
          {{Form::file('image_md')}}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('image_lg', 'Большое изображение акции')}}
        <div>
          {{Form::file('image_lg')}}
        </div>
      </div>
    @elseif($action->action_key == "gift_from_some_sum")
        
    @endif
    {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>
@endsection
