@extends('layouts.app')

@section('content')
    <div class="mb-4"><a href="{{ route('category.create',['property_id'=>$property_id])}}"
                         class="btn btn-outline-light mx-auto d-block">Додати категорію</a></div>

    @foreach($category as $key => $value)
        <div class="card mb-4">


            <div class="card-body">
                <h5 class="card-title text-center">{{$value->name}}</h5>
            </div>

            <div class= "row justify-content-center ">

                <div id="carouselBasicExample{{$key}}"
                     class="carousel slide carousel-fade col-8" data-mdb-ride="carousel">


                    <!-- Inner -->
                    <div class="carousel-inner">
                        @foreach($value->get_photo() as $key1=>$photo)
                        <!-- Single item -->
                        <div class="carousel-item {{$key1 == '0' ?'active':''}}">
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
                <!-- Carousel wrapper -->
            </div>


            <div class="card-body">
                <div class="card-text ">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xs-8 col-md-5">
                            <table class="table">
                                <tr>
                                    <td>Кількість кімнат в номері</td>
                                    <td>{{$value->room_count}}</td>
                                </tr>
                                <tr>
                                    <td>Максимальна кількість людей номері</td>
                                    <td>{{$value->person_max}}</td>
                                </tr>
                                <tr>
                                    <td>Розмір номера(м²)</td>
                                    <td>{{$value->size}}</td>
                                </tr>
                                <tr>
                                    <td>Тип номера</td>
                                    <td>{{$value->get_property_type()->name}}</td>
                                </tr>
                                <tr>
                                    <td>Тип ліжка</td>
                                    <td>{{$value->get_bed_type()->name}}</td>
                                </tr>
                                <tr>
                                    <td>Тип харчування</td>
                                    <td>{{$value->get_meal_type()->name}}</td>
                                </tr>
                                <tr>
                                    <td>Кількість зірок</td>
                                    <td>{{$value->stars}}</td>
                                </tr>
                                <tr>
                                    <td>Рейтингова оцінка</td>
                                    <td>{{$value->grade}}</td>
                                </tr>
                                <tr>
                                    <td>Кількість номерів</td>
                                    <td>{{$value->count}}</td>
                                </tr>
                                <tr>
                                    <td>Ціна за ніч</td>
                                    <td>{{$value->price_per_night}}</td>
                                </tr>


                            </table>
                        </div>

                        </div>
                    <p>{{$value->description}}</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-3 mb-2"><a href="{{ route('category.show', ['id'=>$value->id])}}"
                                                    class="btn btn-outline-primary mx-auto d-block">Редагувати інформацію</a>

                    </div>
                    <div class="col-12 col-md-3 mb-2"><a href="{{ route('category.photo', ['id'=>$value->id])}}"
                                                         class="btn btn-outline-primary mx-auto d-block">Редагувати фото</a>

                    </div>


                    <div class="col-12 col-md-3 mb-2" >

                        <form action="{{ route('category.destroy', ['id'=>$value->id,'property_id'=>$property_id])}}" method="POST" class="pull-right" id="delete_form{{$value->id}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        </form>
                        <a onclick="document.getElementById('delete_form{{$value->id}}').submit();" class="btn btn-outline-dark mx-auto d-block">Видалити категорію</a>
                    </div></div>

            </div>
            <div class="card-footer text-muted">{{$value->created_at}}</div>
        </div>
    @endforeach

@endsection
