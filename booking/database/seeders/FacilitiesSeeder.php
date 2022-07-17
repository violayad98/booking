<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiesSeeder extends Seeder
{
    private  $items = [
        ['Басейн'],
        ['Безкоштовний Wi-Fi'],
        ['Безкоштовна парковка'],
        ['Оздоровчий спа-центр'],
        ['Ресторан'],
        ['Станція для заряджання електричних автомобілів'],
    ];


    public function run()
    {

        foreach ($this->items as $item) {
            DB::table('facilities')->updateOrInsert([
                'name' => $item[0],
            ], [

                'name' => $item[0],
            ]);
        }
    }
}
