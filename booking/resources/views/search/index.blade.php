@extends('layouts.app')

@section('content')
<div id="app">


<!--&lt;!&ndash;        <div class='col-md-4 col-12 mb-4'>
            <div class="card p-4">
                <form id="contact" action="" method="post"
                      class=' form-group col-12'>
                    <div class="mb-1">
                        <label for="date_in" class="form-label ">Заїзд</label>

                        <input name="date_in" type="date"  min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                               class="form-control" id="date_in" placeholder="Заїзд-Виїзд" />

                    </div>
                    <div class="mb-1">
                        <label for="date_out" class="form-label ">Виїзд</label>


                        <input name="date_out" type="date" value="{{\Carbon\Carbon::tomorrow()->format('Y-m-d')}}"
                               class="form-control" id="date_out"  />


                    </div>
                    <div class=" mb-4">

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
                    <h5 class="text-center mb-1">Сортувати за такими критеріями:</h5>

                    <legend class="mt-4">Тип помешкання</legend>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=""
                               id="flexCheckChecked" checked=""> <label
                            class="form-check-label" for="flexCheckChecked"> Апартаменти</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=""
                               id="flexCheckChecked" checked=""> <label
                            class="form-check-label" for="flexCheckChecked"> Готелі</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=""
                               id="flexCheckChecked" checked=""> <label
                            class="form-check-label" for="flexCheckChecked"> Хостели</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=""
                               id="flexCheckChecked" checked=""> <label
                            class="form-check-label" for="flexCheckChecked"> Гостьові будинки</label>
                    </div>
                    &lt;!&ndash; &#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45; &ndash;&gt;
                </form>
            </div>
        </div>&ndash;&gt;-->
<hotel-component v-bind:contrdata="{{json_encode($res)}}"></hotel-component>


</div>

@endsection
