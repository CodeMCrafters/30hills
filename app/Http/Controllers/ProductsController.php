<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //

    public function index(){
        $product = Product::all();

        if($product -> count()>0){
            return response()->json([
                'status' => 200,
                'product'=> $product
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message'=> 'No Records Found'
            ],404);
        }
    }

    public function store(Request $request){

       $data_product = Validator::make($request->all(),[
            "id" => ['required'],
            "name"  => ['required'],
            "description"  => ['required'],
            "features"  => ['required'],
            "price"  => ['required'],
            "keywords"  => ['required'],
            "url"  => ['required'],
            "category"  => ['required'],
            "subcategory"  => ['required'],
            "images" => ['required']
        ]);

        
            if($data_product-> fails()){
                return response()->json([
                    'status' => '422',
                    'errors' => $data_product->message()
                ],422);
            }
            else{
                $product = Product::create([
                    "id"=>$request->id,
                    "name"=>$request->name,
                    "description"=>$request->description,
                    "features"=>$request->features,
                    "price"=>$request->price,
                    "keywords"=>$request->keywords,
                    "url"=>$request->url,
                    "category"=>$request->category,
                    "subcategory"=>$request->subcategory,
                    "images"=>$request->images
                ]);
                try { 
                    if($product){
                        return response()->json([
                            'status' => '200',
                            'message' => "Product create successful"
                        ],200);
                    } 
                    else{
                        return response()->json([
                            'status' => '500',
                            'message' => 'Product isnt create'
                        ],500);
                    }
                  
                }
                catch (\Throwable $th) {
                        dd($th);
                    }                

                
            }
    }

    public function show($id){
        $product = Product::find($id);

        if($product){
            return response()->json([
                'status' => '200',
                'product' => $product
            ],200);
        }
        else{
            return response()->json([
                'status' => '404',
                'message' => 'Product not found'
            ],404);
        }
    }

    public function update(Request $request, int $id){
        $data_product = Validator::make($request->all(),[
            "id" => ['required'],
            "name"  => ['required'],
            "description"  => ['required'],
            "features"  => ['required'],
            "price"  => ['required'],
            "keywords"  => ['required'],
            "url"  => ['required'],
            "category"  => ['required'],
            "subcategory"  => ['required'],
            "images" => ['required']
        ]);

        if($data_product->fails()){
            return response()->json([
                'status' => '422',
                'errors' => $data_product->message()
            ],422);
        }
        else{

        }
        $product = Product::find($id);
        
        if($product){
            try {
                $product ->update([
                "id"=>$request->id,
                "name"=>$request->name,
                "description"=>$request->description,
                "features"=>$request->features,
                "price"=>$request->price,
                "keywords"=>$request->keywords,
                "url"=>$request->url,
                "category"=>$request->category,
                "subcategory"=>$request->subcategory,
                "images"=>$request->images
            ]);

            return response()->json([
                'status' => '200',
                'message' => 'Product updated successful '
            ],200);

            } catch (\Throwable $th) {
                dd($th);
            }
           
        }
        else{
            return response()->json([
                'status' => '404',
                'message' => 'Product doesnt update'
            ],404);
        }


    }

    public function destroy($id){
        $product= Product::find($id);

        if($product){
            try {
                $product->delete();
                return response()->json([
                    'status' => '200',
                    'message' => "Producs deleted successful"
                ],200);
            } catch (\Throwable $th) {
                dd($th);
            }
        }
        else{
            return response()->json([
                'status' => '404',
                'message' => 'No Such Product found'
            ],404);
        }
    }
}
