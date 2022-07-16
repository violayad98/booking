@extends('layouts.app')

@section('content')
    <div class="card   col-12 mb-4">

        <div class="card-body">
            <h5 class="card-title text-center">{{ $reservation->category->property->name }}</h5>

            <h6 class="card-subtitle text-muted text-center">{{ $reservation->category->property->city_name->name}},{{ $reservation->category->property->street}} {{ $reservation->category->property->building}} {{ $reservation->category->property->apt}}</h6>

            <h5 class="card-title text-center">{{ $reservation->check_in}} - {{$reservation->check_out}}</h5>
        </div>
<!--
        <img class='mx-auto d-block' height="200"
             src="/image/{{$reservation->category->property->photo}}">
--><div class= "row justify-content-center ">
        <div id="carouselBasicExample"
             class="carousel slide carousel-fade col-8" data-mdb-ride="carousel">


            <!-- Inner -->
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <img
                        src="/image/{{$reservation->category->property->photo}}" width="1024px"
                        class="d-block w-100" alt="Sunset Over the City" />

                </div>
                @foreach($reservation->category->get_photo() as $key1=>$photo)
                    <!-- Single item -->
                    <div class="carousel-item ">
                        <img
                            src="/image/{{$photo->photo_path}}" width="1024px"
                            class="d-block w-100" alt="Sunset Over the City" />

                    </div>
                @endforeach
                <!--                        &lt;!&ndash; Single item &ndash;&gt;
                        <div class="carousel-item">
                            <img
                                src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/12810588.jpg?k=38772f8d0825b132b56feeaa8d0d974c4c3241acc7e17e94c08b9d4e953a0ed9&o=&hp=1"
                                class="d-block w-100" alt="Canyon at Nigh" />

                        </div>

                        &lt;!&ndash; Single item &ndash;&gt;
                        <div class="carousel-item">
                            <img
                                src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/28413139.jpg?k=c98f013ecfb5b89132cbcf8cd5beb0ea77f0b47eff7701acc4bc841f8b33e0ef&o=&hp=1"
                                class="d-block w-100" alt="Cliff Above a Stormy Sea" />

                        </div>-->
            </div>
            <!-- Inner -->

            <!-- Controls -->
            <button class="carousel-control-prev" type="button"
                    data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button"
                    data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Carousel wrapper -->
    </div>
        <div class="card-body text-center">

            <table class="table">
                <tr>
                    <td>Кількість кімнат в номері</td>
                    <td>{{$reservation->category->room_count}}</td>
                </tr>
                <tr>
                    <td>Максимальна кількість людей номері</td>
                    <td>{{$reservation->category->person_max}}</td>
                </tr>
                <tr>
                    <td>Розмір номера(м²)</td>
                    <td>{{$reservation->category->size}}</td>
                </tr>

                <tr>
                    <td>Тип ліжка</td>
                    <td>{{$reservation->category->get_bed_type()->name}}</td>
                </tr>
                <tr>
                    <td>Тип харчування</td>
                    <td>{{$reservation->category->get_meal_type()->name}}</td>
                </tr>
                <tr>
                    <td>Кількість зірок</td>
                    <td>{{$reservation->category->stars}}</td>
                </tr>
                @if($reservation->category->property->grade != '0')
                <tr>
                    <td>Рейтингова оцінка</td>
                    <td>{{$reservation->category->property->grade}} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 1.5 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg></td>
                </tr>
                @endif


            </table>
            {{$reservation->category->property->description}}
            {{$reservation->category->description}}
            <p class="card-text text-center"><h3>Вартість {{$reservation->amount}} грн</h3></p>
            <div class="row justify-content-center">
                @if($reservation->status=='1'or $reservation->status=='2')
                <div class="col-12 col-md-3 mb-2"><a href="{{ route('reservations.cancel', ['id'=>$reservation->id])}}"
                                                     class="btn btn-outline-primary mx-auto d-block">Відмінити</a>

                </div>
                    @endif

                    @if($reservation->status=='3'&& AUTH::user()->email_verified_at != NULL && !$reservation->feedback)
                        <div class="col-12 col-md-3 mb-2"><a href="{{ route('feedback.new', ['id'=>$reservation->id])}}"
                                                             class="btn btn-outline-primary mx-auto d-block">Залишити відгук</a>

                        </div>
                    @endif
            </div>
        </div>
        <div class="card-footer text-muted">Статус {{ $reservation->status_name->name }}</div>
    </div>
@endsection
