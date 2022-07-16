<template>

    <div class="row p-3">
        <div class="col-12 text-center"><h4>Результати за запитом м.{{ contrdata.city }} {{ contrdata.date_in }}<b>-</b>{{ contrdata.date_out }}
            для {{ contrdata.person }} людей</h4></div>


        <div class='col-md-4 col-12 mb-4'>
            <div class="card p-4">
                <form id="contact" action="" method="post" @submit.prevent="search"
                      class=' form-group col-12'>

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
                    <!-- ------------------------------------------------------ -->
                    <button type="submit"
                            class="btn btn-outline-primary mx-auto d-block">Пошук
                    </button>
                </form>
            </div>
        </div>


        <div class=" col-md-8 col-12">
            <div class="card mb-4" v-for="hotel in hotels">
                <div class="row">
<div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title text-center">{{hotel.name}}</h5>
                    <h6 class="card-subtitle text-muted text-center">{{hotel.address}}</h6>
                </div>
                <img class='mx-auto d-block' height="200"
                     :src="'../image/'+hotel.photo">
    <p class="card-text text-center">{{hotel.description}}</p>
</div>
                    <div class="col-md-4 " >
<table class="table ">
    <tr>
        <td>
           <h5> Зірок</h5>
        </td>
        <td>
            <h5>{{hotel.stars}}</h5>
        </td>
    </tr>
    <tr>
        <td>
            <h5>Оцінка за відгуками</h5>
        </td>
        <td>
            <h5> {{hotel.grade}}</h5>
        </td>
    </tr>
</table><button type="button"
                class="btn btn-outline-primary mx-auto d-block">Ціна від {{hotel.price}}₴
                    </button>
                    </div>

                </div>

            </div>
        </div>
    </div>

</template>


<script>
export default {
    props: [
        'contrdata'
    ],
    data: () => ({
        hotels: [],
        fields: {},
        cities: null,

    }),
    mounted() {
        axios.get('/city')
            .then(res => {
                this.cities = res.data.data;
            })
        console.log(this.contrdata)
        this.search();
    },
    methods: {
        search() {
            this.fields.city = this.contrdata.city_id
            this.fields.date_in = this.contrdata.date_in
            this.fields.date_out = this.contrdata.date_out
            this.fields.person = this.contrdata.person

            axios.post('/search/filter', this.fields)
                .then(res => {
                    console.log(res.data);
                    this.hotels = res.data.data;
                })
        }
    },

}

</script>
