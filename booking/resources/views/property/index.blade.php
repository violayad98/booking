@extends('layouts.app')

@section('content')
    <div class="mb-4"><a href="{{ route('property.create')}}"
            class="btn btn-outline-light mx-auto d-block">Додати об'єкт</a></div>

    @foreach($property as $key => $value)
        <div class="card   col-12 mb-4">

            <div class="card-body">
                <h5 class="card-title text-center">{{ $value->name }}</h5>
                <h6 class="card-subtitle text-muted text-center">{{ $value->city_name->name}},{{ $value->street}} {{ $value->building}} {{ $value->apt}}</h6>
            </div>
            <img class='mx-auto d-block' height="200"
                 src="/image/{{ $value->photo }}">

            <div class="card-body text-center">
                <p class="card-text">{{ $value->description }}</p>
                <p class="card-text">Оцінка за відгуками {{ $value->grade }}</p>

                <div class="row justify-content-center">
                <div class="col-12 col-md-3 mb-2"><a href="{{ route('property.show', ['property'=>$value->id])}}"
                        class="btn btn-outline-primary mx-auto d-block">Редагувати</a>

                </div>
                    <div class="col-12 col-md-3 mb-2"><a href="{{ route('category.index', ['id'=>$value->id])}}"
                                                               class="btn btn-outline-primary mx-auto d-block">Категорії</a>

                    </div>
                    <div class="col-12 col-md-3 mb-2"><a href="{{ route('feedback.property', ['id'=>$value->id])}}"
                                                         class="btn btn-outline-primary mx-auto d-block">Відгуки</a>

                    </div>

                    <div class="col-12 col-md-3 mb-2" >

                        <form action="{{ route('property.destroy', ['property'=>$value->id])}}" method="POST" class="pull-right" id="delete_form{{$value->id}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        </form>
                        <a onclick="document.getElementById('delete_form{{$value->id}}').submit();" class="btn btn-outline-dark mx-auto d-block">Видалити об'єкт</a>
                </div></div>
            </div>
            <div class="card-footer text-muted">Створено {{ $value->created_at }}</div>
        </div>


    @endforeach

@endsection
