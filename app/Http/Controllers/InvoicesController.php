<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $invoices = Credit::orderBy('created_at', 'desc')->where('user_id', $user->id)->whereNotNull('stripe_id')->get();
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
        $date = date('j F, Y');
        $client = User::findOrFail($invoice->user_id);
        $pdf = PDF::loadView('files.pdf', ['invoice' => $invoice, 'date' => $date, 'client' => $client]);
        return $pdf->download($invoice->invoice_id.'.pdf');
    }
}
