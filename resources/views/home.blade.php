@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Заведения</h5>
          <a class="btn btn-primary btn-sm" href="{{route('org.create')}}" role="button">Добавить</a>
        </div>
        <div class="card-body">
          @if(count($orgs) > 0)

          <ul class="list-group list-group-flush">
            @foreach ($orgs as $item)
            <li class="list-group-item">
              <a href="{{route('org.show', ['id' => $item->id])}}">{{$item->name}}</a>
            </li>
            @endforeach
          </ul>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
