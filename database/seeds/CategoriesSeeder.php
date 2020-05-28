<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['id' => 1, 'category' => 'Vegetable', 'created_at' => now()]);
        DB::table('categories')->insert(['id' => 2, 'category' => 'Fruit', 'created_at' => now()]);
        DB::table('categories')->insert(['id' => 3, 'category' => 'Animal', 'created_at' => now()]);
    }
}
