@extends('layouts.app')

@section('content')
        <div class="card   col-12 mb-4">

            <div class="card-body">
                <div class="card-header text-center"><h1>Додавання об'єкту</h1></div>
                <form id="contact" action="{{ route('property.store')}}" method="post"
                      class=' form-group col-12 p-5' enctype="multipart/form-data">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label for="city" class="form-label ">Назва</label>
                            <div class=' '>
                                <input name="name" type="text" required
                                       class="form-control" id="name"
                                />
                            </div>

                        </div>
                        <div class="col-12 mb-1">
                            <label for="city" class="form-label ">Місто</label>
                            <select class="form-select"  name="city"  id="city" required>
                                <option ></option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-12 mb-4">

                            <label for="adult" class="form-label ">Вулиця</label>
                            <div class=''>
                                <input name="street" type="text" required
                                       class="form-control" id="street"
                                />
                            </div>

                        </div>
                        <div class="col-12 mb-4">

                            <label for="adult" class="form-label ">Будівля</label>
                            <div class=''>
                                <input name="building" type="text" required
                                       class="form-control" id="building"
                                />
                            </div>

                        </div>
                        <div class="col-12 mb-4">

                            <label for="adult" class="form-label ">Квартира</label>
                            <div class=''>
                                <input name="apt" type="text" required
                                       class="form-control" id="apt"
                                />
                            </div>

                        </div>

                        <div class="col-12 mb-4">

                            <label for="adult" class="form-label ">Опис об'єкту</label>
                            <div class=''>
                                <input name="description" type="text" required
                                       class="form-control" id="description"
                                />
                            </div>

                        </div>
                        <div class="col-12 mb-4">
                        <label for="adult" class="form-label ">Зручності</label>
                        @foreach($facilities as $value)
                        <div class="form-check" >

                            <input class="form-check-input" type="checkbox" value='{{$value->id}}' name="facilities[]"
                                   id="flexCheckChecked" > <label
                                class="form-check-label" >{{$value->name}}</label>


                        </div>  @endforeach
                        </div>
                        <div class="text-center">
                        <div class="form-group">
                            <label for="formFile" class="form-label mt-4">Головне фото об'єкта</label>
                            <input class="form-control" type="file" id="photo" name="photo" required >

                        </div>
                        <div style="text-align: center" class="col-12 mb-1">


                            <button type="submit" class="btn btn-primary btn-lg">Зберегти</button>


                        </div>

                    </div>
                </form>
            </div>

        </div>



@endsection
