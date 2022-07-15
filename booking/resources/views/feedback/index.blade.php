@extends('layouts.app')

@section('content')

    @foreach($feedback as $key => $value)
        <div class="card   col-12 mb-4">


            <div class="card-body">
                <h5 class="card-title text-center">
                    <a href="{{ route('reservations.show', ['id'=>$value->reservation_id])}}"
                       class="">{{ $value->reservation->category->property->name }}</a>

                </h5>
                <h6 class="card-subtitle text-muted text-center"></h6>
            </div>
            <img class='mx-auto d-block' height="300"
                 src="/image/{{ $value->reservation->category->property->photo}}">

            <div class="card-body">
                <div class="card-text ">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xs-8 col-md-4">
                            <table class="table">
                                <tr>
                                    <td>Відгук</td>
                                    <td>{{ $value->description }}</td>
                                </tr>
                                <tr>
                                    <td>Оцінка</td>
                                    <td>{{ $value->grade }} / 10.0</td>
                                </tr>


                            </table>
                        </div>
                    </div>
                </div>





            <div class="card-footer text-muted">Створено {{ $value->created_at }}</div>
        </div>


    @endforeach

@endsection
