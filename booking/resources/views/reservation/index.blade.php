@extends('layouts.app')

@section('content')

    @foreach($reservations as $key => $value)
        <div class="card   col-12 mb-4">

            <div class="card-body">
                <h5 class="card-title text-center">{{ $value->category->property->name }}</h5>

                <h6 class="card-subtitle text-muted text-center">{{ $value->category->property->city_name->name}},{{ $value->category->property->street}} {{ $value->category->property->building}} {{ $value->category->property->apt}}</h6>

                <h5 class="card-title text-center">{{ $value->check_in}} - {{$value->check_out}}</h5>
            </div>
            <img class='mx-auto d-block' height="200"
                 src="/image/{{$value->category->property->photo}}">

            <div class="card-body">
                <p class="card-text text-center">Вартість {{$value->amount}} грн</p>
                <div class="row justify-content-center">
                <div class="col-12 col-md-3 mb-2"><a href="{{ route('reservations.show', ['id'=>$value->id])}}"
                        class="btn btn-outline-primary mx-auto d-block">Переглянути</a>

                </div>
                   </div>
            </div>
            <div class="card-footer text-muted">Статус {{ $value->status_name->name }}</div>
        </div>


    @endforeach

@endsection
