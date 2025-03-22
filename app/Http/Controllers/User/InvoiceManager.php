<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class InvoiceManager extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'clientsCount' => DB::table('customers')->where('userId', auth()->user()->id)->count(),
            'invoiceStats' => Invoice::where('userId', auth()->user()->id)
                ->selectRaw('COUNT(*) as invoicesCount')
                ->selectRaw('SUM(CASE WHEN status = "paid" THEN grandTotal ELSE 0 END) as totalPaid')
                ->selectRaw('SUM(CASE WHEN status = "unpaid" THEN grandTotal ELSE 0 END) as totalUnpaid')
                ->first(),
        ];
        $data['invoices'] = Invoice::where('userId', auth()->user()->id)
            ->with('customer') // Eager load the customer relationship
            ->latest()
            ->get();
        return view('user.invoices.index', $data);
        
    }
    public function create(Request $request)
    {
        $entPriceName = auth()->user()->enterPriceName;
        $entPriceName = $entPriceName??substr(auth()->user()->firstName, 0, 2);
        
        $entPriceName = str_replace(' ', '', $entPriceName);
        $entPriceName = strtoupper($entPriceName);
        
        $lstInvNum = Invoice::where([
            'userId' => $request->user()->id,
           
        ])->whereDate( 'created_at' , date('Y-m-d'))->latest()->first();
        if ($lstInvNum) {
            
            $lstInvNum = $lstInvNum->invoiceNumber;
            $lstInvNum = explode('-', $lstInvNum);
            $lstInvNum = $lstInvNum[1];
            $lstInvNum = (int)$lstInvNum + 1;
            $lstInvNum = str_pad($lstInvNum, 4, '0', STR_PAD_LEFT);
           
            $data['invoiceNumber'] = substr($entPriceName, 0, 2) . '-' . $lstInvNum;
        } else {
            $data['invoiceNumber'] = substr($entPriceName, 0, 2) . '-' . date('ymd') . '0001';
        }
        return view('user.invoices.create',$data);
    }
    public function store(Request $request)
    {
        //validate the request
        $request->validate([
            'customer' => 'required|exists:customers,id',
            'invoiceNumber' => 'required|min:1|unique:invoices,invoiceNumber',
            'invoiceDate' => 'required|date',
            'dueDate' => 'required|date|after_or_equal:invoiceDate',
            'status' => 'required|in:paid,unpaid',

            'product' => 'required|array|min:1',
            'product.*' => 'required|string',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|numeric|min:1',
            'unitPrice' => 'required|array|min:1',
            'unitPrice.*' => 'required|numeric|min:0',
            'tax' => 'required|array|min:1',
            'tax.*' => 'required|numeric|min:0|max:100',
        ], [
          
            'product.required' => 'At least one product is required.',
            'product.*.required' => 'Each product name is required.',
            'product.*.string' => 'Each product name must be a string.',
            'quantity.required' => 'At least one quantity is required.',
            'quantity.*.required' => 'Each quantity is required.',
            'quantity.*.numeric' => 'Each quantity must be a number.',
            'quantity.*.min' => 'Each quantity must be at least 1.',
            'unitPrice.required' => 'At least one unit price is required.',
            'unitPrice.*.required' => 'Each unit price is required.',
            'unitPrice.*.numeric' => 'Each unit price must be a number.',
            'unitPrice.*.min' => 'Each unit price must be at least 0.',
            'tax.required' => 'At least one tax value is required.',
            'tax.*.required' => 'Each tax value is required.',
            'tax.*.numeric' => 'Each tax value must be a number.',
            'tax.*.min' => 'Each tax value must be at least 0.',
            'tax.*.max' => 'Each tax value must not exceed 100.',
        ]);
      try{
        DB::beginTransaction();
        //store the invoice
        $invoice = new Invoice();
        $invoice->userId = auth()->user()->id;
        $invoice->customerId = $request->customer;
        $invoice->invoiceNumber = $request->invoiceNumber;
        $invoice->invoiceDate = $request->invoiceDate;
        //  $invoice->dueDate = $request->dueDate;
        $invoice->totalAmount = 0;
        $invoice->taxAmount = 0;
        $invoice->grandTotal = 0;
        $invoice->discount    = 0;
        $invoice->status = $request->status;
        $invoice->save();
        // Validate that at least one invoice item is provided
       

        // Store invoice items
        foreach ($request->product as $index => $product) {
            $quantity = $request->quantity[$index];
            $unitPrice = $request->unitPrice[$index];
            $tax = $request->tax[$index];
            $total = ($quantity * $unitPrice) + (($quantity * $unitPrice) * ($tax / 100));

            $item = new InvoiceItem();
            $item->invoiceId = $invoice->id;
            $item->productName = $product;
            $item->quantity = $quantity;
            $item->unitPrice = $unitPrice;
          //  $item->tax = $tax;
            $item->totalPrice = $total;
            $item->save();
        }

        // Update invoice totals
        $invoice->totalAmount = $invoice->items->sum('totalPrice');
        if ($request->discountType === 'percentage') {
            $invoice->discount = ($request->discount / 100) * $invoice->totalAmount;
        } elseif ($request->discountType === 'fixed') {
            $invoice->discount = $request->discount;
        }

        $invoice->grandTotal = $invoice->totalAmount - $invoice->discount + $invoice->taxAmount;
        $invoice->taxAmount = $invoice->totalAmount * 0.1; // Example tax calculation (10%)
        $invoice->grandTotal = $invoice->totalAmount + $invoice->taxAmount;
        $invoice->save();
        DB::commit();
    }catch(\Exception $e){
        DB::rollBack();
        Log::error($e->getMessage());
        return back()->withErrors('Something went wrong');
    }
        return back()->with(['swtSuccess' => 'Invoice created successfully']);
    }
}
