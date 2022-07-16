@extends('layouts.app')

@section('content')
    <div class="row p-3">
        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
            <h1>Подорожуй Україною </br> разом з нами.</h1>
            <p class="lead">Насолоджуйся якісним сервісом і бронюй житло у будь-якому куточку країни в один клік</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">

            <img
                src={{ asset('assets/images/ukr.PNG') }}
                border="0" style="max-width: 100%;
									">

        </div>
    </div>
    <form id="contact" action="{{ route('search') }}" method="post"
          class=' form-group col-12 p-5'>
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-1">
                <label for="city" class="form-label ">Місто</label>
                <div class='input-group '>
						<span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
</svg></span> <select
                        class="form-select" id="city" name='city'       required>
                        <option value="" ></option>

                        @foreach($cities as $city)
                            <option value="{{$city->id}}" >{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <div class="col-lg-2 col-md-6 mb-1">
                <label for="date_in" class="form-label ">Заїзд</label>

                    <input name="date_in" type="date"  min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                           class="form-control" id="date_in" placeholder="Заїзд-Виїзд" />

            </div>
            <div class="col-lg-2 col-md-6 mb-1">
                <label for="date_out" class="form-label ">Виїзд</label>


                    <input name="date_out" type="date" value="{{\Carbon\Carbon::tomorrow()->format('Y-m-d')}}"
                           class="form-control" id="date_out"  />


            </div>
            <div class="col-lg-2 col-md-4 mb-1">

                <label for="person" class="form-label ">Людей</label>
                <select
                    class="form-select" id="person" name='person'>

                    <option>1</option>
                    <option selected>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>

                </select>

            </div>

            <div style="text-align: center" class="col-lg-2 col-md-4 mb-1">


                <button type="submit" class="btn btn-primary btn-lg">Пошук</button>


            </div>

        </div>
    </form>



@endsection
