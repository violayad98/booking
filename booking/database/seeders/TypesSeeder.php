<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    private  $items_property = [
        ['Номер'],
        ['Апартаменти'],
        ['Гостьовий будинок'],

    ];
    private  $items_meal = [
        ['Сніданок включено'],
        ['Сніданок і вечерю включено'],
        ['Все включено'],
        ['З власною кухнею'],
        ['Харчування не передбачене'],

    ];
    private  $items_bed = [
        ['Односпальне ліжко'],
        ['Двоспальне ліжко'],
        ['Диван'],


    ];

    public function run()
    {
        foreach ($this->items_property as $item) {
            DB::table('property_types')->updateOrInsert([
                'name' => $item[0],
            ], [

                'name' => $item[0],
            ]);
        }
        foreach ($this->items_meal as $item) {
            DB::table('meal_types')->updateOrInsert([
                'name' => $item[0],
            ], [

                'name' => $item[0],
            ]);
        }
        foreach ($this->items_bed as $item) {
            DB::table('bed_types')->updateOrInsert([
                'name' => $item[0],
            ], [

                'name' => $item[0],
            ]);
        }
    }
}
