@extends('layouts.app')

@section('content')
        <div class="card   col-12 mb-4">

            <div class="card-body">
                <div class="card-header text-center"><h1>Додавання відгуку</h1></div>
                <form id="contact" action="{{ route('feedback.store')}}" method="post"
                      class=' form-group col-12 p-5' enctype="multipart/form-data">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input name="reservation_id" type="hidden" value="{{$id}}"/>

                    <div class="row">
                        <div class="col-12 mb-1">
                            <label for="city" class="form-label ">Назва</label>
                            <div class=' '>
                                <input name="name" type="text" required
                                       class="form-control" id="name"
                                />
                            </div>

                        </div>


                        <div class="col-12 col-md-12  mb-4">

                            <label for="description" class="form-label ">Відгук</label>
                            <div class=''>
                                <textarea  name="description" row="3"
                                           class="form-control" id="description"></textarea>

                            </div>

                        </div>
                        <div class="col-12 col-md-12  mb-4">

                            <label for="grade" class="form-label ">Оцінка за 10-бальною шкалою</label>
                            <div class=''>
                                <input name="grade" type="number" step="0.1" min="0" max="10"
                                       class="form-control" id="grade" required
                                />
                            </div>

                        </div>
                        <div style="text-align: center" class="col-12 mb-1">


                            <button type="submit" class="btn btn-primary btn-lg">Зберегти</button>


                        </div>
                    </div>
                </form>
            </div>

        </div>



@endsection
