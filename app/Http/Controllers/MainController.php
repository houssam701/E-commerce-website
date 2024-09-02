<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Video;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function adminViewProducts(){
        $products = Product::with('productImages')->get();
        return view('admin-view-products', ['products'=>$products]);

    }
    public function addingVideo(){
    $videos = Video::all();
    return view('admin-add-video', compact('videos'));
    }
    public function editProductPage(Product $product){
        $types = Type::all();
        return view('admin-edit-product',['product'=>$product,'types'=>$types]);
    }
    public function adminAdding(){
        $types = Type::all();
        return view('admin-adding', ['types'=>$types]);
    }
    public function searchProduct(Request $request){
    $request->validate([
        'query' => 'required|max:250'
    ]);

    // Get the search term
    $query = $request->input('query');

   // Use the Scout search method
    $products = Product::search($query)->get();
    // Load the related product images
    $products->load('productImages');
    
    // $products = Product::where('name', 'LIKE', "%{$query}%")
    // ->with('productImages')
    // ->get();

    // Return the search results to the view
    return view('admin-view-products',['products'=>$products]);
    }
    public function search(Request $request){
        $request->validate([
            'query' => 'required|max:250'
            ]);
            // Get the search term
            $query = strip_tags($request->input('query'));
            // Use the Scout search method
            $products = Product::search($query)->get();
            $products->load('productImages');
            return view('viewSearchProduct',['products'=>$products]);
    }
}