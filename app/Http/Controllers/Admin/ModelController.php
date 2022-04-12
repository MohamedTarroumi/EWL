<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PModel;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function getAllModels()
    {
        try {
            $models= PModel::get()->all();
            
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully",
                "data" => json_encode($models)],200);
    }

    public function getBrandModel($modelId)
    {
        try {
            $models= PModel::where('id',$modelId)->get()->first();
            if ($models)
            $brand = $models->brand;
            else
            $brand =null;

        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully ",
                "data" => json_encode($brand)],200);
    }

    public function getModelsBasedOnBrand( $brandId )
    {
        try {
            $models= PModel::where('brand_id',$brandId)->get()->all();
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully ",
                "data" => json_encode($models)],200);
    }
    public function getModelsBasedOnBrandAndCategory( $brandId,$categoryId )
    {
        try {
            $models= PModel::where('brand_id',$brandId)->where('category_id',$categoryId)->get()->all();
        } catch (\Throwable $th) {
            return  response()->json([
                "success" => false,
                "message" => "An error happend during getting data",
                 "error" =>$th->getMessage()],400);
        }
      
            return  response()->json([
                "success" => true,
                "message" => "successfully ",
                "data" => json_encode($models)],200);
    }
}
