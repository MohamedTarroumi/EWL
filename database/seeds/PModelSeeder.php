<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('models')->insert([
            'name' => 'SM I9500',
            'brand_id' => 1,

        ]);
        DB::table('models')->insert([
            'name' => 'SM I9505',
            'brand_id' => 1,

        ]);
        DB::table('models')->insert([
            'name' => 'SM I300',
            'brand_id' => 1,

        ]);
        DB::table('models')->insert([
            'name' => 'HW P2',
            'brand_id' => 2,

        ]);
        //
        DB::table('models')->insert([
            'name' => 'HW Y1',
            'brand_id' => 2,

        ]);
        DB::table('models')->insert([
            'name' => 'LG 250',
            'brand_id' => 3,

        ]);
    }
}
