<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    private  $items = [
        ['Очікує підтвердження'],
        ['Активний'],
        ['Завершений'],
        ['Не активний'],
        ['Видалений'],
        ['Відмінений'],
    ];


    public function run()
    {

        foreach ($this->items as $item) {
            DB::table('statuses')->updateOrInsert([
                'name' => $item[0],
            ], [

                'name' => $item[0],
            ]);
        }
    }
}
