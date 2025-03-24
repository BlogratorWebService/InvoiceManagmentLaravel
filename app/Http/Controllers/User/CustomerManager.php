<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;

class CustomerManager extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::where('userId', $request->user()->id)->get();
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
            'postal_code' => 'required|digits:6|numeric',
            'city' => 'required|string|max:255|nullable',
            'street_address' => 'required|string|max:255',
            'gstNumber' => 'string|max:15|min:15|nullable',
        ]);

        try {
            $zipResp = Http::withOptions(['verify' => false])->get('https://api.postalpincode.in/pincode/' . $request->postal_code);
            $state = $zipResp[0]['PostOffice'][0]['State'];
            $dist = $zipResp[0]['PostOffice'][0]['District'];
        } catch (\Exception $e) {
            return back()->withErrors('Invalid Postal Code');
        }
        $stateCode = null;
        $gstStateCodes = json_decode(file_get_contents(public_path('gstCodes.json')), true);
        if ($state ) {
         
            $stateCode = $gstStateCodes[$state] ?? null;

           
        }
      

        $customer = new Customer();
        $customer->userId = $request->user()->id;
        $customer->name = $request->fullName;
        $customer->email = $request->email;
        $customer->phone = $request->phoneNumber;
        $customer->addressLine1 = $request->street_address;
        $customer->city = $request->city;
        $customer->state = $state;
        $customer->zip = $request->postal_code;
        $customer->gstNumber = $request->gstNumber;
        $customer->save();

        return redirect()->route('customer.index')->with(['swtSuccess' => 'Customer Added SuccessFully']);
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
