<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('products')->insert([
                'name' => 'SM'.$this->generateRandomString(),
                'reference' => 'R-'.strtoupper($this->generateRandomString(6)),
                'prix' => mt_rand(100,1200),
                'description' => $this->generateRandomString(1000),
                'file' => 'file'.$this->generateRandomString(10),
                'feautres_file' => 'file'.$this->generateRandomString(10),
                'category_id' =>mt_rand(1,5),
                'brand_id' => mt_rand(1,5),
                'model_id' =>mt_rand(1,5),
                'created_by' => 1,
                'updated_by' =>1,
               
              
    
            ]);
        }
      
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
