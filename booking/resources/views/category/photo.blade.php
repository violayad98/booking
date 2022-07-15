@extends('layouts.app')

@section('content')
    <form id="contact" action="{{ route('category.photo_add',['category_id'=>$category->id])}}" method="post"
          class=' form-group col-12 p-5' enctype="multipart/form-data">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

        <div class="row">
        <div class="col-12 col-md-2"> <h3>Додати фото</h3></div>
        <div class="col-12 col-md-8"><input class="form-control" type="file" id="photo" name="photo[]" multiple required ></div>


        <div  class="col-12 col-md-2 ">


            <button type="submit" class="btn btn-primary ">Зберегти</button>


        </div></div>
    </form>
<div class="row">
    @foreach($photos as $key => $photo)
        <div class="col-12 col-md-3">
        <div class="card mb-4"  >
            <img
                src="/image/{{$photo->photo_path}}" width="1024px"
                class="d-block w-100" alt="Sunset Over the City" />
            <div class="card-body">
                <div class="row justify-content-center">

                    <div class="col-12 "><a href="{{ route('category.photo_delete', ['path'=>$photo->photo_path,'id'=>$category->id])}}"
                                                         class="btn btn-outline-dark mx-auto d-block">Видалити фото</a>

                    </div>
                </div>
            </div>
        </div>


        </div>
    @endforeach
        <a href="{{ route('category.index', ['id'=>$category->property_id])}}" class="btn btn-primary ">Назад</a>
    </div>
@endsection
