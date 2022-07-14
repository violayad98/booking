@extends('layouts.app')

@section('content')
        <div class="card   col-12 mb-4">

            <div class="card-body">
                <div class="card-header text-center"><h1>Редагування об'єкту</h1></div>
                <form id="contact" action="{{ route('property.update', ['property'=>$property->id]) }}" method="post"
                      class=' form-group col-12 p-5' enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label for="city" class="form-label ">Назва</label>
                            <div class=' '>
                                <input name="name" type="text"
                                       class="form-control" id="name" value="{{$property->name}}"
                                />
                            </div>

                        </div>
                        <div class="col-12 mb-1">
                            <label for="date" class="form-label ">Місто</label>
                            <div class=''>

                                <input name="city" type="text"
                                       class="form-control" id="city" value="{{$property->city}}" />
                            </div>

                        </div>
                        <div class="col-12 mb-4">

                            <label for="adult" class="form-label ">Вулиця</label>
                            <div class=''>
                                <input name="street" type="text"
                                       class="form-control" id="street"value="{{$property->street}}"
                                />
                            </div>

                        </div>
                        <div class="col-12 mb-4">

                            <label for="adult" class="form-label ">Будівля</label>
                            <div class=''>
                                <input name="building" type="text"
                                       class="form-control" id="building"value="{{$property->building}}"
                                />
                            </div>

                        </div>
                        <div class="col-12 mb-4">

                            <label for="adult" class="form-label ">Квартира</label>
                            <div class=''>
                                <input name="apt" type="text"
                                       class="form-control" id="apt"value="{{$property->apt}}"
                                />
                            </div>

                        </div>

                        <div class="col-12 mb-4">

                            <label for="adult" class="form-label ">Опис об'єкту</label>
                            <div class=''>
                                <input name="description" type="text"
                                       class="form-control" id="description"value="{{$property->description}}"
                                />
                            </div>

                        </div>
                        <div class="text-center">
                            <img src="/image/{{ $property->photo }}" width="300px"></div>
                        <div class="form-group">
                            <label for="formFile" class="form-label mt-4">Головне фото об'єкта</label>
                            <input class="form-control" type="file" id="photo" name="photo" value="/public/image/{{ $property->photo }}">

                        </div>
                        <div style="text-align: center" class="col-12 mb-1">


                            <button type="submit" class="btn btn-primary btn-lg">Зберегти</button>


                        </div>

                    </div>
                </form>
            </div>

            <div class="card-footer text-muted">Створено {{ $property->created_at }}</div>
        </div>



@endsection
