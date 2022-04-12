<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class BrandController extends Controller
{
    public function index()
    {
        try {
            $brands= Brand::get()->all();
            
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully",
                "data" => json_encode($brands)],200);
    }

    public function getallbrands()
    {
        try {
            $brands= Brand::get()->all();
            
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully",
                "data" => json_encode($brands)],200);
    }

    public function getCategoryBrand($brandId)
    {
        try {
            $brands= Brand::where('id',$brandId)->get()->first();
            if ($brands)
            $categories = $brands->categories;
            else
            $categories =null;

        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully ",
                "data" => json_encode($categories)],200);
    }

    public function getbrandsBasedOnCategory( $categoryId )
    {
        try {
            $category= Category::where('id',$categoryId)->get()->first();
            $brands = $category->brands;
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully ",
                "data" => json_encode($brands)],200);
    }

    public function store(Request $req)
    {
        Log::info('store function brand' );

        try {
            $brand = new Brand();
            $brand->name=$req->input('name');
            Log::info('brand name'. $req->input('name'));
            $brand->save();
            
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully",
                "data" => json_encode($brand)],200);
    }

    public function delete($id)
    {
        try {
            $brand= Brand::find($id);
            $brand->delete();            
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully",
                "data" => json_encode($brand)],200);
    }

    public function update(Request $req,$id)
    {
        try {
            $brand= Brand::find($id);
            $brand->name=$req->name;
            $brand->save();
            
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully",
                "data" => json_encode($brand)],200);
    }

    
}
