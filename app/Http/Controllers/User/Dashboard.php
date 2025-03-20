<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
//use App\Models\Invoice;
class Dashboard extends Controller
{
    function index () {
    $data['customerCount'] = Customer::where('userId',auth()->id())->count();
  //  $data['invoiceCount'] = Invoice::where('userId',auth()->id())->count();
   // $data['productCount'] = Product::where('userId',auth()->id())->count();
    
        return view('user.dashboard',$data);
    }
}
