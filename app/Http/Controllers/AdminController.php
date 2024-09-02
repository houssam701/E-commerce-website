<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Type;
use App\Models\Order;
use App\Models\Video;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\productImages;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    
    public function addingType(Request $request){
        $validated =$request->validate([
            'name' => 'required|string|max:255',
            'image' => ['required','image', 'mimes:jpg,jpeg,png,gif,svg'], // validate each file
        ]);
        $type = new Type();
        $type->name =strip_tags($validated['name']);
        $imagePath = $validated['image']->store('images','public');
        $type->image_path=$imagePath;
        $type->save();
        return redirect('/admin-adding')->with('successs',"Adding type successfuly.");
    }
    public function addingProduct(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'min:2', 'max:250'],
            'price' => ['required', 'numeric', 'min:1'],
            'quantity' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'min:2', 'max:1200', 'string'],
            'type_id' => 'required|exists:types,id',
            'images' => ['required'], // validate presence of images
            'images.*' => ['image', 'mimes:jpg,jpeg,png,gif,svg'], // validate each file
        ]);
    
        // Create the product
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'type_id' => $validated['type_id']
        ]);
    
        // Handle the uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store the image in the storage/app/images directory
                $imagePath = $image->store('images','public');
    
                // Save the image path in the product_images table
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }
    
        return redirect('/admin-adding')->with('success', "Product added successfully.");
    }
    public function delete(Request $request){
        $productId = $request->input('product');
        $product = Product::find($productId);        
        if ($product) {
            $images = $product->productImages;

            // Delete each image from storage
            foreach ($images as $image) {
                $imagePath ='public/'.$image->image_path; // Assuming the image path is stored as 'images/filename.jpg'
                if (Storage::disk('local')->exists($imagePath)) {
                    Storage::disk('local')->delete($imagePath);
                } else {
                    // Log or handle the case where the image does not exist
                    Log::warning("Image not found: " . $imagePath);
                }
            }
                $product->delete();
                    return response()->json(['message' => 'Product deleted successfully.']);
        } else {
            return response()->json(['message' => 'Product not found.']);
        }
    }
    public function typeDelete(Request $request){
        $typeId = $request->input('type');
        $type = Type::find($typeId);
        if ($type) {
            $image=$type->image_path;
            $imagePath ='public/'.$image; // Assuming the image path is stored as 'images/filename.jpg'
            if (Storage::disk('local')->exists($imagePath)) {
                Storage::disk('local')->delete($imagePath);
            }
            $type->delete();
            return response()->json(['message' => 'Type deleted successfully.']);
            } else {
                return response()->json(['message' => 'Type not found.']);
            }
    }
    public function editProduct(Request $request,Product $product){
        $validated = $request->validate([
            'name' => ['required', 'min:2', 'max:250'],
            'price' => ['required', 'numeric', 'min:1'],
            'quantity' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'min:2', 'max:1200', 'string'],
            'type_id' => 'required|exists:types,id',
            'images' => [''], // validate presence of images
            'images.*' => ['image', 'mimes:jpg,jpeg,png,gif,svg', 'max:2048'], // validate each file
        ]);
        $validated['name']=strip_tags($validated['name']);
        $validated['description']=strip_tags($validated['description']);
        $product->name=$validated['name'];
        $product->description=$validated['description'];
        $product->price=$validated['price'];
        $product->quantity=$validated['quantity'];
        $product->type_id=$validated['type_id'];

        // Delete the old image from storage
        if ($request->hasFile('images')) {
            $images = $product->productImages;
        foreach ($images as $image) {
            $imagePath ='public/'.$image->image_path; // Assuming the image path is stored as 'images/filename.jpg'
            if (Storage::disk('local')->exists($imagePath)) {
                Storage::disk('local')->delete($imagePath);
                $image->delete();
            } else {
                // Log or handle the case where the image does not exist
                Log::warning("Image not found: " . $imagePath);
            }
        }
        }
        //adding the new image 
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store the image in the storage/app/images directory
                $imagePath = $image->store('images','public');

                // Save the image path in the product_images table
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }
        $product->save();
        return redirect('/admin-view-products')->with("successEdit","Product has been updated!");    
}
public function showClients()
{
    $orders = Order::with('orderProducts.product')
                ->where('situation', '!=', 'done')
                ->get();

    return view('adminClients', compact('orders'));
}
public function orderDone(Request $request){
    $order_id=$request->input('order');
    $order=Order::find($order_id);
    $order->situation='done';+
    $order->save();
    return response()->json(['message' => 'Order done successfully.']);
}   
public function orderDelete(Request $request){
    $order = Order::find($request->input('order'));
    $order->delete();
    return response()->json(['message' => 'Order deleted successfully.']);
}
public function addVideo(Request $request){
    $request->validate([
        'video' => 'required|mimes:mp4,mov,ogg,qt', // adjust max size as needed
    ]);

    if ($request->hasFile('video')) {
        $videoPath = $request->file('video')->store('videos', 'public');

        $video = new Video();
        $video->video = $videoPath;
        $video->save();

        return redirect()->back()->with('success', 'Video uploaded successfully.');
    }

}
public function deleteVideo($id){
    $video = Video::findOrFail($id);
    if (Storage::disk('public')->exists($video->video)) {
        Storage::disk('public')->delete($video->video);
    }

    // Delete the video record from the database
    $video->delete();

    return redirect()->back()->with('successs', 'Video deleted successfully.');
}

}