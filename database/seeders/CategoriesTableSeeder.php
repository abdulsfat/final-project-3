<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = ['sport', 'finance', 'automotive'];

        foreach ($categories as $category) {
            DB::table('categories')->insert(['name' => $category]);
        }
    }
}
