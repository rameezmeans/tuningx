@extends('layouts.app')

@section('content')
@include('layouts.nav')
<main>
    <div class="container">
        <h1 class="h1-olsx-history">{{__('Invoices')}}</h1>
        <div class="table-history-panel">
            <div class="row invoice-panel">
                @if(count($invoices) == 0)
                    <p>{{__('No Invoices found.')}}</p>
                @else

                <table class="invoices">
                    <thead>
                        <tr>
                            <th>{{__('Invoice Ref.')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
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
                                    <a href="{{ route('pdfview',['id'=>$invoice->id]) }}" target="_blank" data-position="bottom" data-tooltip="Download">
                                        <i class="fa fa-download"></i>
                                        <strong> Download</strong>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
