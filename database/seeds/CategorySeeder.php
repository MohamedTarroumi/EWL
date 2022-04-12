<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'PC',
          //  'email' => Str::random(10).'@gmail.com',
          // 'password' => Hash::make('password'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Smart Phone',
          //  'email' => Str::random(10).'@gmail.com',
          // 'password' => Hash::make('password'),
        ]);
        //
        DB::table('categories')->insert([
            'name' => 'TV',
          //  'email' => Str::random(10).'@gmail.com',
          // 'password' => Hash::make('password'),
        ]);
        DB::table('categories')->insert([
            'name' => 'Accessory',
          //  'email' => Str::random(10).'@gmail.com',
          // 'password' => Hash::make('password'),
        ]);
    }
}
