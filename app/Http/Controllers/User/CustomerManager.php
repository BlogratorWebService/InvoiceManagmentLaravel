<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
class CustomerManager extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::where('userId',$request->user()->id)->get();
        return view('user.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('user.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'phoneNumber' => 'required|digits:10|numeric|unique:customers,phone',
            'address' => 'required|string|max:255',
        ]);

        $customer = new Customer();
        $customer->userId = $request->user()->id;
        $customer->name = $request->fullName;
        $customer->email = $request->email;
        $customer->phone = $request->phoneNumber;
        $customer->address = $request->address;
        $customer->save();

        return redirect()->route('customer.index')->with(['swtSuccess'=>'Customer Added SuccessFully']);
    }

    public function show(Request $request)
    {
      //  $customers = Customer::find($request->auth()->id,'userId');
        return view('user.customers.show', compact('customers'));
    }

    public function edit(Customer $customer)
    {
        return view('user.customers.edit', compact('customer'));
    }
}
