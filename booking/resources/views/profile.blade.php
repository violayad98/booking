@extends('layouts.app')

@section('content')
    @if(Auth::user()->email_verified_at === NUll)
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Увага</h4>
            <p class="mb-0">Ваша пошта не підтверджена. Для підтвердження перейдіть за посиланням у листі.
            Для повторної відправки листа натисніть <a href="{{ route('mail.send') }}" class="alert-link">ТУТ</a></p>
        </div>
    @endif
    <div class="row justify-content-center ">
    <div class="col-12 col-sm-10 col-md-10  ">
        <div class="card">
            <div class="card-header text-center"><h1>Профіль</h1></div>
    <form id="contact" action="{{ route('profile.save') }}" method="post"
          class=' form-group col-12 p-5'>
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <div class="row">
            <div class="col-12 mb-1">
                <label for="city" class="form-label ">Ім'я</label>
                <div class=' '>
						 <input name="name" type="text"
                                                                              class="form-control" id="name" value="{{Auth::user()->name}}"
                                                                              />
                </div>

            </div>
            <div class="col-12 mb-1">
                <label for="date" class="form-label ">Вік</label>
                <div class=''>

                    <input name="age" type="number"
                           class="form-control" id="age" value="{{Auth::user()->age}}" />
                </div>

            </div>
            <div class="col-12 mb-4">

                <label for="adult" class="form-label ">Країна</label>
                <div class=''>
						<input name="country" type="text"
                                                                              class="form-control" id="country"value="{{Auth::user()->country}}"
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
    </div>


@endsection
