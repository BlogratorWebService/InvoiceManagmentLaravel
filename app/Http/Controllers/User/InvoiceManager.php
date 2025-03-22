<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceManager extends Controller
{
    public function index(Request $request)
    {
        return view('user.invoices.index');
    }
    public function create(Request $request)
    {
        $entPriceName = auth()->user()->enterPriceName;
        $entPriceName = str_replace(' ', '', $entPriceName);
        $entPriceName = strtoupper($entPriceName);
        $lstInvNum = Invoice::where([
            'userId'=>$request->auth()->id,
            'created_at'=>now()->format('Y-m-d')
            ])->latest()->first();
        if($lstInvNum){
            $lstInvNum = $lstInvNum->invoiceNumber;
            $lstInvNum = explode('-',$lstInvNum);
            $lstInvNum = $lstInvNum[1];
            $lstInvNum = (int)$lstInvNum + 1;
            $lstInvNum = str_pad($lstInvNum,4,'0',STR_PAD_LEFT);
            $data['invoiceNumber'] = substr($entPriceName,0,1).'-'.date('Ymd').($lstInvNum+1);
        }
        $data['invoiceNumber'] = substr($entPriceName,0,1).'-'.date('Ymd').'0001';

        return view('user.invoices.create');
    }
    public function store(Request $request)
    {
        //validate the request
        $request->validate([
            'customer' => 'required|exists:customers,id',
            'invoiceNumber' => 'required|min:1|unique:invoices,invoiceNumber',
            'invoiceDate' => 'required',
            'dueDate' => 'required',
            'status' => 'required|in:paid,unpaid',
        ]);
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
        return back()->with(['swtSuccess' => 'Invoice created successfully']);
    }
}
