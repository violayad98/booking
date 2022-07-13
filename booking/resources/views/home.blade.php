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
    <form id="contact" action="" method="post"
          class=' form-group col-12 p-5'>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-1">
                <label for="city" class="form-label ">Місто</label>
                <div class='input-group '>
						<span class="input-group-text"><i
                                class="bi bi-geo-alt-fill"></i></span> <input name="city" type="text"
                                                                              class="form-control" id="city"
                                                                              placeholder="Куди ви хочете поїхати?" required="" />
                </div>

            </div>
            <div class="col-lg-3 col-md-6 mb-1">
                <label for="date" class="form-label ">Дати</label>
                <div class='input-group '>
                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                    <input name="date" type="text"
                           class="form-control" id="date" placeholder="Заїзд-Виїзд" />
                </div>

            </div>
            <div class="col-lg-2 col-md-4 mb-1">

                <label for="adult" class="form-label ">Дорослих</label>
                <select
                    class="form-select" id="adult" name='adult'>

                    <option>1</option>
                    <option selected>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>

            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <label for="kids" class="form-label ">Дітей</label> <select
                    class="form-select" id="kids" name='kids'>
                    <option>0</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>

            </div>
            <div style="text-align: center" class="col-lg-2 col-md-4 mb-1">


                <button type="submit" class="btn btn-primary btn-lg">Пошук</button>


            </div>

        </div>
    </form>



@endsection
