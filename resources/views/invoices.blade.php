@extends('layouts.app')

@section('content')
@include('layouts.nav')
<main>
    <div class="container">
        <h1 class="h1-olsx-history">Invoices</h1>
        <div class="table-history-panel">
            <div class="row invoice-panel">
                <table class="invoices">
                    <thead>
                        <tr>
                            <th>Invoice Ref.</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td><strong>{{$invoice->invoice_id}}</strong></td>
                                <td>{{ $invoice->created_at->format('Y-m-d')  }}</td>
                                <td>EUR {{$invoice->price_payed}}</td>
                                <td>
                                    <span class="label label-green">
                                        Paid
                                        <i class="fa fa-check"></i>
                                    </span>
                                </td>
                                <td>
                                    <a href="http://resellers.ecutech.tech/API/ZOHO/GetInvoice/261618000003716001/INV-1608" target="_blank" data-position="bottom" data-tooltip="Download">
                                        <i class="fa fa-download"></i>
                                        <strong> Download</strong>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
