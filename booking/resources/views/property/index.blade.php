@extends('layouts.app')

@section('content')
    <div class="mb-4"><a href="{{ route('property.create')}}"
            class="btn btn-outline-light mx-auto d-block">Додати об'єкт</a></div>

    @foreach($property as $key => $value)
        <div class="card   col-12 mb-4">

            <div class="card-body">
                <h5 class="card-title text-center">{{ $value->name }}</h5>
                <h6 class="card-subtitle text-muted text-center">{{ $value->city}},{{ $value->street}} {{ $value->building}} {{ $value->apt}}</h6>
            </div>
            <img class='mx-auto d-block' height="200"
                 src="/image/{{ $value->photo }}">

            <div class="card-body">
                <p class="card-text">{{ $value->description }}</p>
                <div class="row justify-content-center">
                <div class="col-12 col-md-3"><a href="{{ route('property.show', ['property'=>$value->id])}}"
                        class="btn btn-outline-primary mx-auto d-block">Редагувати</a>

                </div>
                    <div class="col-12 col-md-3"><a href="{{ route('property.show', ['property'=>$value->id])}}"
                                          class="btn btn-outline-primary mx-auto d-block">Категорії</a>

                    </div>
                    <div class="col-12 col-md-3"><a href="{{ route('property.show', ['property'=>$value->id])}}"
                                          class="btn btn-outline-success mx-auto d-block">Додати категорію</a>

                    </div>
                    <div class="col-12 col-md-3" >

                        <form action="{{ route('property.destroy', ['property'=>$value->id])}}" method="POST" class="pull-right" id="delete_form">
                            <input type="hidden" name="_method" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        </form>
                        <a onclick="document.getElementById('delete_form').submit();" class="btn btn-outline-dark mx-auto d-block">Видалити об'єкт</a>
                </div></div>
            </div>
            <div class="card-footer text-muted">Створено {{ $value->created_at }}</div>
        </div>


    @endforeach

@endsection
