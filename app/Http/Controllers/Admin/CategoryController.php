<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getallcategories()
    {
        try {
            $categorys= Category::get()->all();
            
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()]);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "Succusfly ",
                "data" => json_encode($categorys)]);
    }

    public function getCategoryWithId($categoryId)
    {
        try {
            $category= Category::where('id',$categoryId)->get()->all();

        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()]);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "Succusfly ",
                "data" => json_encode($category)]);
    }

    public function getbrandsBasedOnCategory( $categoryId )
    {
        try {
            $category= Category::where('id',$categoryId)->get()->first();
            if ($category)
            $brands = $category->brands;
            else
            $brands = null;
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()]);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "Succusfly ",
                "data" => json_encode($brands)]);
    }
}
