<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
class frontApiManager extends Controller
{
    public function getCustomers(Request $request)
    {
        $search = $request->input('search');

        $items = Customers::where('name', 'LIKE', "%$search%")
            ->select('id', DB::raw('concat(name," ", "(",email,")") as text'),'gstNumber') // Select 'id' and 'text' for Select2
            ->get();
    
        return response()->json(['items' => $items]);
    }
    public function getProducts(Request $request)
    {
        $search = $request->input('search');

        $items = Product::where('name', 'LIKE', "%$search%")
            ->select('id', DB::raw('concat(name," ", "(",hsnCode,")") as text'),'hsnCode','price') // Select 'id' and 'text' for Select2
            ->get();
            return response()->json(['items' => $items]);
    
    }
}
