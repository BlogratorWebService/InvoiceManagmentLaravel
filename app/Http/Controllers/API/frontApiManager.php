<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;
class frontApiManager extends Controller
{
    public function getCustomers(Request $request)
    {
        $search = $request->input('q');

        $items = Customers::where('name', 'LIKE', "%$search%")
            ->select('id', DB::raw('concat(name," ", "(",email,")") as text')) // Select 'id' and 'text' for Select2
            ->get();
    
        return response()->json(['items' => $items]);
    }
}
