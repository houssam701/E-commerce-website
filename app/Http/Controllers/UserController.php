<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Video;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function viewHome(){
        $types = Type::all();
        $video = Video::orderBy('created_at', 'asc')->first();

        $products = Product::with('firstImage')->get();
        return view('home',['types'=>$types,'products'=>$products,'video'=>$video]);
    }
    public function viewProduct(Product $product){
        $relatedProducts = Product::where('type_id', $product->type_id)
                        ->where('id', '!=', $product->id) 
                        ->get();
        return view('viewProduct',['product'=>$product,'relatedProducts'=>$relatedProducts]);
    }
    public function viewProductType(Type $type){
        $typeName=$type->name;
        $relatedProducts = Product::where('type_id',$type->id)->get();
        return view('productPage',['relatedProducts'=>$relatedProducts,'typeName'=>$typeName]);    
    }
}   