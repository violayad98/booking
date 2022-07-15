@extends('layouts.app')

@section('content')
    <div class="card   col-12 mb-4">

        <div class="card-body">
            <div class="card-header text-center"><h1>Додавання категорії</h1></div>
            <form id="contact" action="{{ route('category.update',['id'=>$category->id])}}" method="post"
                  class=' form-group col-12 p-5' enctype="multipart/form-data">
                <input name="property_id" type="hidden" value="{{ $category->property_id }}"/>

                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 mb-1">
                        <label for="city" class="form-label ">Назва</label>
                        <div class=' '>
                            <input name="name" type="text" value="{{$category->name}}"
                                   class="form-control" id="name"required
                            />
                        </div>

                    </div>
                    <div class="col-12 col-md-6 mb-1">
                        <label for="room_count" class="form-label ">Кількість кімнат в номері</label>
                        <div class=''>

                            <input name="room_count" type="number" value="{{$category->room_count}}"
                                   class="form-control" id="room_count"  required/>
                        </div>

                    </div>
                    <div class="col-12 col-md-6  mb-4">

                        <label for="person_max" class="form-label ">Максимальна кількість людей номері</label>
                        <div class=''>
                            <input name="person_max" type="number" value="{{$category->person_max}}"
                                   class="form-control" id="person_max"required
                            />
                        </div>

                    </div>
                    <div class="col-12 col-md-6  mb-4">

                        <label for="size" class="form-label ">Розмір номера(м²)</label>
                        <div class=''>
                            <input name="size" type="number" value="{{$category->size}}"
                                   class="form-control" id="size" required
                            />
                        </div>

                    </div>
                    <div class="col-12 col-md-6  mb-4">

                        <label for="property_type" class="form-label ">Тип номера</label>
                        <select class="form-select"  name="property_type"  id="property_type" required>
                            @foreach($property_types as $type)
                                <option value="{{$type->id}}" {{$type->id == $category->property_type ?'selected':''}} >{{$type->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-12 col-md-6  mb-4">

                        <label for="bed_type" class="form-label ">Тип ліжка</label>
                        <select class="form-select"  name="bed_type"  id="bed_type" required>
                            @foreach($bed_types as $type)
                                <option value="{{$type->id}}" {{$type->id == $category->bed_type ?'selected':''}} >{{$type->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-12 col-md-6  mb-4">

                        <label for="meal_type" class="form-label ">Тип харчування</label>
                        <select class="form-select"  name="meal_type"  id="meal_type" required>
                            @foreach($meal_types as $type)
                                <option value="{{$type->id}}" {{$type->id == $category->meal_type ?'selected':''}}>{{$type->name}}</option>
                            @endforeach
                        </select>

                    </div><div class="col-12 col-md-6  mb-4">

                        <label for="stars" class="form-label ">Кількість зірок</label>
                        <div class=''>
                            <input name="stars" type="number" value="{{$category->stars}}"
                                   class="form-control" id="stars" min="1" max="5" required
                            />
                        </div>

                    </div>
                    <div class="col-12 col-md-6  mb-4">

                        <label for="count" class="form-label ">Кількість номерів</label>
                        <div class=''>
                            <input name="count" type="number" value="{{$category->count}}"
                                   class="form-control" id="count" required
                            />
                        </div>

                    </div><div class="col-12 col-md-6  mb-4">

                        <label for="price_per_night" class="form-label ">Ціна за ніч</label>
                        <div class=''>
                            <input name="price_per_night" type="number" step="0.01" value="{{$category->price_per_night}}"
                                   class="form-control" id="price_per_night" required
                            />
                        </div>

                    </div>




                    <div class="col-12 col-md-6  mb-4">

                        <label for="description" class="form-label ">Опис номера</label>
                        <div class=''>
                                <textarea  name="description" row="3"
                                           class="form-control" id="description">{{$category->description}}</textarea>

                        </div>

                    </div>
                    <div class="text-center">

                        <div style="text-align: center" class="col-12 mb-1">


                            <button type="submit" class="btn btn-primary btn-lg">Зберегти</button>


                        </div>

                    </div>
            </form>
        </div>

    </div>



@endsection
