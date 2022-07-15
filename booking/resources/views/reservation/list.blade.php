@extends('layouts.app')

@section('content')

    @foreach($reservations as $key => $value)
        <div class="card   col-12 mb-4">
            <div class="row">
                <div class="card-body col-md-6">
                    <h5 class="card-title text-center">{{ $value->category->property->name }} </h5>
                    <h6 class="card-title text-center">{{ $value->category->name }}</h6>
                    <h6 class="card-subtitle text-muted text-center mb-4">{{ $value->category->property->city_name->name}}
                        ,{{ $value->category->property->street}} {{ $value->category->property->building}} {{ $value->category->property->apt}}</h6>


                    <img class='mx-auto d-block mb-4' height="200"
                         src="/image/{{$value->category->property->photo}}">


                </div>

                <div class="card-body col-md-6">

                    <table class="table">
                        <tr>
                            <td>Ім'я гостя</td>
                            <td>{{$value->user->name}}</td>

                        </tr>
                        <tr>
                            <td>Пошта гостя</td>
                            <td>{{$value->user->email}}</td>

                        </tr>

                        <tr>
                            <td>Країна гостя</td>
                            <td>{{$value->user->country}}</td>

                        </tr>
                        <tr>
                            <td>Дата заїзду</td>
                            <td>{{$value->check_in}}</td>

                        </tr>
                        <tr>
                            <td>Дата виїзду</td>
                            <td>{{$value->check_out}}</td>

                        </tr>
                        <tr>
                            <td>Вартість</td>
                            <td>{{$value->amount}} грн</td>

                        </tr>
                    </table>
                    @if($value->status=='1')
                        <div class="col-12 col-md-6 mb-2"><a
                                href="{{ route('reservations.confirm', ['id'=>$value->id])}}"
                                class="btn btn-outline-success mx-auto d-block">Підтвердити</a>
                        </div>
                    @elseif($value->status=='2')
                        <div class="row">
                            <div class="col-12 col-md-6 mb-2"><a
                                    href="{{ route('reservations.end', ['id'=>$value->id])}}"
                                    class="btn btn-outline-primary mx-auto d-block">Завершити</a>
                            </div>
                        <div class="col-12 col-md-6 mb-2"><a
                                href="{{ route('reservations.cancel_owner', ['id'=>$value->id])}}"
                                class="btn btn-outline-dark mx-auto d-block">Відмінити</a>
                        </div>
                        </div>
                    @endif


                </div>
            </div>
            <div class="card-footer text-muted">Статус {{ $value->status_name->name }}</div>
        </div>

    @endforeach

@endsection
