<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

use App\Attachement;

use App\Http\Services\UploadFileInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\ProductResource;
use Exception;

use Symfony\Component\HttpFoundation\File\File;

class ProductController extends Controller
{

    public function __construct(UploadFileInterface $uploadFile)
    {
        $this->uploadFile = $uploadFile;
    }

    public function index(Request $req)
    {
        
        if ($req->input('title')) {
            $title = $req->input('title');
            // $products = Product::where('name', 'like', '%' . $title . '%')->get();
            return new ProductResource(Product::where('name', 'like', '%' . $title . '%')->pagination(4));

        } else {
          //  dd(ProductResource::collection(Product::all()));
          return ProductResource::collection(Product::paginate(4));
         //  $products = Product::get();
        }
        // foreach ($products as &$product) {
        //     $product->created_by = $product->createdBy;
        //     $product->update_by =  $product->updatedBy;
        //     $product->model_id =  $product->model;
        //     $product->brand_id = $product->brand;
        //     $product->category_id = $product->category;
        //     $product->files = $product->files;
        // }
        // return  response()->json($products);
    }

    

    public function store(Request $req)
    {
        $attachements = array();
        $path = "/images/products";
        try {
            foreach ($req->file as $file) {
                $uploadedFile = $this->uploadFile->upload($file, $path);
                array_push($attachements, ['name' => $uploadedFile['name'], 'path' => $path, 'type' => $uploadedFile['type']]);
             
            }
            $product = $this->saveProduct($req, $attachements);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => $th->getMessage(),
                "code" => $th->getCode(),
            ], 400);
        }
        return response()->json([
            "success" => true,
            "message" => "Product successfully uploaded",
            "product" =>   $product
        ], 200);
    }

    public function update(Request $req, $id)
    {
        $path = "\images\products";

        try {
            if ($req->file) {
                foreach ($req->file as $file) {
                    $fileName = $this->uploadFile->upload($file, $path);
                }
            }
            $product = $this->editProduct($req, $id, $fileName);
        } catch (\Throwable $th) {
            Log::info('error' . $th->getMessage());
            return response()->json([
                "success" => false,
                "message" => $th->getMessage(),
                "code" => $th->getCode(),

            ], 400);
        }
        return response()->json([
            "success" => true,
            "message" => "Product successfully uploaded",
            "product" =>   $product
        ], 200);
    }

    public function saveProduct(Request $req, $files)
    {
     
        $attachements = array();
        $prod = json_decode($req->data);
        $product = new Product;
        foreach ($prod as  $key => $attr) {
            if ($key != 'file[]')
                $product->$key = $attr;
        }



        //$product->files->sync($attachements);
        $product->file = 'yes to';
        $product->created_by = 1;
        try {
            $product->save();
            foreach ($files as $file) {
                $currentfile = new Attachement(['name' => $file['name'], 'path' => $file['path'], 'type' => $file['type'], 'created_by' => 1]);

                array_push($attachements,  $currentfile);
            }
            $product->files()->delete();
            $product->files()->saveMany($attachements);
        } catch (\Throwable $th) {
            throw new exception('error during save' . $th->getMessage());
        }

        return $product;
    }

    public function editProduct(Request $req, $productId, $files)
    {
        $attachements = array();
        $prod = json_decode($req->data);
        $product = Product::get($productId);
        if ($product) {
            foreach ($prod as  $key => $attr) {
                if ($key != 'file[]')
                    $product->$key = $attr;
            }
        }

        $product->file = 'frffrfr';
        $product->created_by = 1;
        try {
            $product->save();
            foreach ($files as $file) {
                $currentfile = new Attachement(['name' => $file['name'], 'path' => $file['path'], 'type' => $file['type'], 'created_by' => 1]);

                array_push($attachements,  $currentfile);
            }
            $product->files()->delete();
            $product->files()->saveMany($attachements);
        } catch (\Throwable $th) {
            throw new exception('error during save' . $th->getMessage());
        }
        return $product;
    }
    public function download($filename)
    {
        set_time_limit(0);

        $file = new File(storage_path('app/public/EMS/' . $filename));
        $size = \File::size($file);
        $mime = $file->getMimeType();
        $headers = array(
            'Content-Type' =>  $mime,
            'Content-Length' => $size,
        );
        $response =  Response::download($file, $filename, $headers);
        ob_end_clean();

        return $response;
    }
    /**
     * Get all files in a spectific folder
     */
    public function getAllFiles()
    {
        $files = Storage::files("EMS/");
        $filesNames = array();
        foreach ($files as $key => $value) {
            $value = str_replace("EMS/", "", $value);
            array_push($filesNames, $value);
        }
        return  response()->json($filesNames);
    }
    public function uploadFile()
    {
        return view('product/pro');
    }
    /**
     * Get all products in system
     */
    public function getAllProducts()
    {
        try {
            $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            throw new exception('Error during get data from database' . $th->getMessage());
        }
        return response($products, 200);
    }

    /**
     * Get a particular product based on filed
     */
    public function getProduct($filed)
    {
        try {
            if (Product::where('id', $filed)->exists()) {
                $book = Product::where('id', $filed)->get()->toJson(JSON_PRETTY_PRINT);
                return response($book, 200);
            } else {
                return response()->json([
                    "message" => "Product not found"
                ], 404);
            }
        } catch (\Throwable $th) {
            throw new exception('Error during get data from database' . $th->getMessage());
        }
    }
}
