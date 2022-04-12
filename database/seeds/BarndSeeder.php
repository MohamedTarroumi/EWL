<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class BanrdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'SAMSUNG',
            'category_id'=> 2,
          //  'email' => Str::random(10).'@gmail.com',
          // 'password' => Hash::make('password'),
        ]);

        DB::table('brands')->insert([
            'name' => 'HUAWEI',
            'category_id'=> 2,
          //  'email' => Str::random(10).'@gmail.com',
          // 'password' => Hash::make('password'),
        ]);
        //
        DB::table('brands')->insert([
            'name' => 'LG',
            'category_id'=> 3,
          // 'password' => Hash::make('password'),
        ]);
        DB::table('brands')->insert([
            'name' => 'NOKIA',
            'category_id'=> 2,
          //  'email' => Str::random(10).'@gmail.com',
          // 'password' => Hash::make('password'),
        ]);
    }
}
