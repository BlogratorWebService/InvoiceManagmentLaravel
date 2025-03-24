<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductManager extends Controller
{
   public function index(Request $request)
   {
       $data = [
           'products' => Product::where('userId', auth()->user()->id)
               ->latest()
               ->paginate(15),
       ];
       return view('user.products.index', $data);
   }
   public function create(Request $request)
   {
       return view('user.products.create');
   }
    public function store(Request $request)
    {
         //validate the request
         $request->validate([
              'productName' => 'required|min:3',
              'price' => 'required|numeric|min:0',
              'description' => 'nullable',
              'hsnCode' => 'nullable',
         ]);
         $product = new Product();
         $product->userId = auth()->user()->id;
         $product->name = $request->productName;
         $product->price = $request->price;
         $product->hsnCode = $request->hsnCode;
         $product->description = $request->description;
         $product->save();
         return redirect(route('product.index'))->with(['success'=>'Product added successfully']);
    }
}
