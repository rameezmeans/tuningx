<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;
use PDF;

class InvoicesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $invoices = Credit::orderBy('created_at', 'desc')->whereNotNull('stripe_id')->get();
        return view('invoices', ['invoices' => $invoices]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showPDF()
    {
        $invoice = Credit::findOrFail(13);
        return view('files.pdf', ['invoice' => $invoice]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function makePDF(Request $request)
    {
        $invoice = Credit::findOrFail($request->id);
        $pdf = PDF::loadView('files.pdf', ['invoice' => $invoice]);
        return $pdf->download($invoice->invoice_id.'.pdf');
    }
}
