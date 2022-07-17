<template>

    <div class="row p-3">
        <div class="col-12 text-center"><h4>Результати за запитом м.{{ contrdata.city }} {{ contrdata.date_in }}<b>-</b>{{ contrdata.date_out }}
            для {{ contrdata.person }} людей</h4></div>


        <div class='col-md-4 col-12 mb-4'>
            <div class="card p-4">
                <form id="contact" action="" method="post" @submit.prevent="search"
                      class=' form-group col-12'>

                    <legend class="mt- ">Сортувати за :</legend>

                    <div class="form-check" >
                        <input type="radio" class="form-check-input" name="sort"  value="1" v-model="filter.sort" @change="search">
                        <label
                            class="form-check-label" >Ціною↑ </label>
                    </div>
                    <div class="form-check" >
                        <input type="radio" class="form-check-input" name="sort"  value="2" v-model="filter.sort" @change="search">
                        <label
                            class="form-check-label" >Ціною↓ </label>
                    </div>

                    <div class="form-check" >
                        <input type="radio" class="form-check-input" name="sort"  value="3" v-model="filter.sort" @change="search">
                        <label
                            class="form-check-label" >За рейтингом</label>
                    </div>

                    <h5 class="text-center  mt-4">Фільтрувати за такими критеріями:</h5>

                    <legend class="mt-4">Ціна за ніч</legend>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="75" name="price" v-model="filter.price" @change="search"
                               id="price" > <label
                        class="form-check-label" >До 75₴</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="150" name="price" v-model="filter.price" @change="search"
                               id="price" > <label
                        class="form-check-label" >До 150₴</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="300" name="price" v-model="filter.price" @change="search"
                               id="price" > <label
                        class="form-check-label" >До 300₴</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="" name="price" v-model="filter.price" @change="search"
                               id="price" > <label
                        class="form-check-label" >Будь-яка</label>
                    </div>

                    <legend class="mt-4">Тип помешкання</legend>

                    <div class="form-check" v-for="val in property">
                        <input class="form-check-input" type="checkbox" :value="val.id" name="property_type" v-model="filter.property_type" @change="search"
                               id="property_type" > <label
                        class="form-check-label" >{{val.name}}</label>
                    </div>

                    <legend class="mt-4">Тип ліжка</legend>

                    <div class="form-check" v-for="val1 in bed">
                        <input class="form-check-input" type="checkbox" :value="val1.id" name="bed_type" v-model="filter.bed_type" @change="search"
                               id="flexCheckChecked" > <label
                        class="form-check-label" >{{val1.name}}</label>
                    </div>

                    <legend class="mt-4">Тип харчування</legend>

                    <div class="form-check" v-for="val in meal">
                        <input class="form-check-input" type="checkbox" :value="val.id" name="meal_type" v-model="filter.meal_type" @change="search"
                               id="flexCheckChecked" > <label
                        class="form-check-label" >{{val.name}}</label>
                    </div>
                    <legend class="mt-4">Зручності</legend>

                    <div class="form-check" v-for="val1 in facilities">
                        <input class="form-check-input" type="checkbox" :value="val1.id" name="facilities" v-model="filter.facilities_type" @change="search"
                               id="flexCheckChecked" > <label
                        class="form-check-label" >{{val1.name}}</label>
                    </div>
                    <legend class="mt-4">Кількість зірок</legend>

                    <div class="form-check" >
                        <input class="form-check-input" type="checkbox" value="1" name="" v-model="filter.stars" @change="search"
                               id="flexCheckChecked" > <label
                        class="form-check-label" >1</label>
                    </div>
                    <div class="form-check" >
                    <input class="form-check-input" type="checkbox" value="2" name="" v-model="filter.stars" @change="search"
                               id="flexCheckChecked" > <label
                        class="form-check-label">2</label></div>
                    <div class="form-check" >

            <input class="form-check-input" type="checkbox" value="3" name="" v-model="filter.stars" @change="search"
                               id="flexCheckChecked" > <label
                        class="form-check-label" >3</label>
                    </div>
                    <div class="form-check" >

                    <input class="form-check-input" type="checkbox" value="4" name="" v-model="filter.stars" @change="search"
                               id="flexCheckChecked" > <label
                        class="form-check-label" >4</label>
                    </div>
                    <div class="form-check" >
                        <input class="form-check-input" type="checkbox" value="5" name="" v-model="filter.stars" @change="search"
                               id="flexCheckChecked" > <label
                        class="form-check-label" >5</label>
                    </div>
                    <legend class="mt-4">Оцінка за відгуками</legend>

                    <div class="form-check" >
                        <input type="radio" class="form-check-input" name="grade"  value="9" v-model="filter.grade" @change="search">
                         <label
                        class="form-check-label" >Відмінно 9+</label>
                    </div>
                    <div class="form-check" >
                        <input type="radio" class="form-check-input" name="grade"  value="8" v-model="filter.grade" @change="search">
                        <label
                            class="form-check-label" >Дуже добре 8+</label>
                    </div>
                    <div class="form-check" >
                        <input type="radio" class="form-check-input" name="grade"  value="7" v-model="filter.grade" @change="search">
                        <label
                            class="form-check-label" >Добре 7+</label>
                    </div>
                    <div class="form-check" >
                        <input type="radio" class="form-check-input" name="grade"  value="6" v-model="filter.grade" @change="search">
                        <label
                            class="form-check-label" >Досить добре 6+</label>
                    </div>
                    <div class="form-check" >
                        <input type="radio" class="form-check-input" name="grade"  value="0" v-model="filter.grade" @change="search">
                        <label
                            class="form-check-label" >Будь-яка</label>
                    </div>
                    <!-- ------------------------------------------------------ -->

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
</table><a type="button" :href="'search/show/'+hotel.id+'/'+fields.date_in+'/'+fields.date_out+'/'+fields.person"
                class="btn btn-outline-primary mx-auto d-block">Ціна від {{hotel.price}}₴
                    </a>
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
        facilities:null,
        meal: null,
        property: null,
        bed: null,
        recalk:null,
        filter: {
            property_type: [],
            meal_type: [],
            bed_type: [],
            stars:[],
            grade:'',
            sort:'',
            price:'',
            facilities_type: [],

        }

    }),
    mounted() {
        axios.get('/type/meal')
            .then(res => {
                this.meal = res.data.data;
            })
        axios.get('/type/property')
            .then(res => {
                this.property = res.data.data;
            })
        axios.get('/type/bed')
            .then(res => {
                this.bed = res.data.data;
            })
        axios.get('/type/facilities')
            .then(res => {
                this.facilities = res.data.data;
            })

        this.search();
    },
    methods: {
        search() {

            this.fields.city = this.contrdata.city_id
            this.fields.date_in = this.contrdata.date_in
            this.fields.date_out = this.contrdata.date_out
            this.fields.person = this.contrdata.person
            this.fields.filter=this.filter

            axios.post('/search/filter', this.fields)
                .then(res => {
                    console.log(res.data);
                    this.hotels = res.data.data;
                })
        },

    },

}

</script>
