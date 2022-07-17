@extends('layouts.app')

@section('content')

        <div class="card   col-12 mb-4">

            <div class="card-body">
                <h5 class="card-title text-center">{{ $property->name }}</h5>
                <h6 class="card-subtitle text-muted text-center">{{ $property->city_name->name}},{{ $property->street}} {{ $property->building}} {{ $property->apt}}</h6>
            </div>
            <img class='mx-auto d-block' height="200"
                 src="/image/{{ $property->photo }}">

            <div class="card-body text-center">
                <p class="card-text">{{ $property->description }}</p>

                @if(count($categories)=='0')
                    <h4>Нажаль на обрані дати немає номерів</h4>
                @endif
                <table class="table">
                    @foreach($categories as $key=>$category)
                    <tr>
                        <td>
                            <div class="card ">
                                <h4 class="card-title text-center">{{ $category->name }}</h4>
                                <div class="row">
                                <div class="col-md-6">
                                    <div id="carouselBasicExample{{$key}}"
                                         class="carousel slide carousel-fade col-8" data-mdb-ride="carousel">


                                        <!-- Inner -->
                                        <div class="carousel-inner">
                                            @foreach($category->get_photo() as $key1=>$photo)
                                                <!-- Single item -->
                                                <div class="carousel-item {{$key1 == '0' ?'active':''}}">
                                                    <img
                                                        src="/image/{{$photo->photo_path}}" width="1024px"
                                                        class="d-block w-100" alt="Sunset Over the City" />

                                                </div>

                                            @endforeach

                                        </div>
                                        <!-- Inner -->

                                        <!-- Controls -->
                                        <button class="carousel-control-prev" type="button"
                                                data-mdb-target="#carouselBasicExample{{$key}}" data-mdb-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                                data-mdb-target="#carouselBasicExample{{$key}}" data-mdb-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>


                            <div class="col-6 col-md-3">
                                <table class="table">
                                    <tr>
                                        <td>Кількість кімнат в номері</td>
                                        <td>{{$category->room_count}}</td>
                                    </tr>
                                    <tr>
                                        <td>Максимальна кількість людей номері</td>
                                        <td>{{$category->person_max}}</td>
                                    </tr>
                                    <tr>
                                        <td>Розмір номера(м²)</td>
                                        <td>{{$category->size}}</td>
                                    </tr>
                                    <tr>
                                        <td>Тип номера</td>
                                        <td>{{$category->get_property_type()->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Тип ліжка</td>
                                        <td>{{$category->get_bed_type()->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Тип харчування</td>
                                        <td>{{$category->get_meal_type()->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Кількість зірок</td>
                                        <td>{{$category->stars}} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 1.5 16 16" class="bi bi-star"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg></td>
                                    </tr>


                                    <tr>
                                        <td>Ціна за ніч</td>
                                        <td>{{$category->price_per_night}}₴</td>
                                    </tr>


                                </table>
                            </div>
                                    <div class="col-6 col-md-3">
                                        <div class="row justify-content-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$key}}" @guest  disabled @endguest>
                                                Забронювати
                                            </button>


                                        </div>
                                    </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Підтвердити бронювання</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Готель   {{ $property->name}}</p>
                                        <p>Категорія   {{ $category->name }}</p>
                                        <p>Ціна   {{ $category->price_per_night*$request['diff']}}₴ </p>
                                        {{$request['date_in']}} - {{$request['date_out']}},{{$request['person']}} людини

                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('reservations.add', ['id'=>$category->id,'date_in'=>$request['date_in'],'date_out'=>$request['date_out'],'person'=>$request['person']])}}"
                                           class="btn btn-outline-primary mx-auto d-block">Забронювати</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Відмінити</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>





                <p class="card-text">Оцінка за відгуками {{ $property->grade }}</p>
                <div class="row">
@foreach($feedback as $value)
                    <div class="card text-white bg-primary  m-3 col-md-4" style="max-width: 20rem;">
                        <div class="card-header">{{$value->reservation->user->name}}</div>
                        <div class="card-body">
                            <h4 class="card-title">{{$value->name}}</h4>
                            <p class="card-text">{{$value->description}}</p>
                        </div>
                    </div>
                @endforeach
                </div>

        </div>



<!--
            &lt;!&ndash; Modal &ndash;&gt;
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Підтвердити бронювання</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Готель   {{ $property->name}}</p>
                            {{$request['date_in']}} - {{$request['date_out']}},{{$request['person']}} людини

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Відмінити</button>
                            <button type="button" class="btn btn-primary">Підтвердити </button>
                        </div>
                    </div>
                </div>
            </div>
-->


@endsection
