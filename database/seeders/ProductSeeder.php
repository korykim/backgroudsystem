<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * 自定义要填充的数据
         */

//        DB::table('product')->insert([
//            'name' => Str::random(10),
//            'detail' => Str::random(10),
//        ]);


        Product::factory()->count(10)->create();
    }
}
