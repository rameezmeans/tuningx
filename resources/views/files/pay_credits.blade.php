@extends('layouts.app')

@section('pagespecificstyles')

<style>

    html,body{
    overflow:auto;
    }
        .red-olsx-text{
            font-size: 1.2rem;
        }

        .swal-footer {
    text-align: center !important;
}   

.swal2-html-container {
    text-align: center !important;
    align-content: center !important;
}

.swal2-confirm {
    
    background-color: #dc3741 !important;
    
}

.swal2-deny {
    
    background-color: grey !important;
    
}

.swal2-html-container {
    text-align: left;
}

.swal-button--catch{
    display: inline-block;
    background-color: rgb(240, 36, 41) !important;
}

.row-form {
    display: flex !important;
}

.swal2-input {
    margin-left: 15px !important;
    margin-right: 15px !important;
    width: 92% !important;
}

.swal2-html-container {
    overflow: inherit !important;
}
</style>

@endsection


@section('content')
@include('layouts.nav')

<main class="">
    <div class="header-background-classic-full"></div>
        <div class="container">
            <div class="file-service-process">
                <div class="row">
                <div class="col s12 l4 m3">
                    <div class="target wow fadeInDownBig pinned" style="visibility: visible; top: 40px;">
                        <div class="brand-middle-panel hide-on-med-and-down">
                            <img src="@if($file->vehicle()){{ $file->vehicle()->Brand_image_URL }} @else {{ env('BACKEND_URL').'/icons/logos/logo_white.png' }} @endif" alt="logo">
                        <div class="car-loader" id="car-loader" style="display: none;"></div>
                        </div>
                        <div class="stage-pricing" data-stageevo="0">
                            <div class="status-automatic" id="check-loader" style="display: none;">
                                <span class="label label-black">
                                    Loading...
                                </span>
                            </div>
                            <div class="status-automatic" id="automatic" style="display: none">
                                <span class="label label-green wow flash animated animated" style="visibility: visible;">
                                    Automatic
                                    <i class="fa fa-flash"></i>
                                </span>
                                <strong>This request will be processed by our automatic system. Related file will be instantly
            delivered.
        </strong>
                            </div>
                            <div class="status-automatic" id="not-automatic" style="">
                                                                            <span class="label label-black wow flash" style="visibility: visible;">
                                        {{ $file->brand }}
                                        
                                    </span>
                                    <strong>{{__('You need to pay the Credits to submit the file.')}}</strong>
                            </div>
                            <div class="row">
                                <div class="col s12 center m-t-sm">
                                    {{-- <span class="label label-green"><i class="custom-icon-check-decagram"></i> Original file</span> --}}
                                </div>
                            </div>
                            <div id="rows-for-credits">
                                {{-- <div class="divider-light"></div> --}}
                                {{-- <p class="tuning-resume">Stage 0 <small>3 credits</small></p> --}}
                            </div>
                            <div class="options-resume"></div>
                            <div class="divider-light"></div>
                            <div class="totals"><p class="red-olsx-text">{{__('Credits Required')}} <small><span id="total-credits">{{$credits}}</span> credits</small></p></div>
                            <div class="totals"><p class="red-olsx-text">{{__('Account Credits')}}<small><span id="account-credits">{{ Auth::user()->credits->sum('credits') }}</span> credits</small></p></div>
                            @if(Auth::user()->credits->sum('credits') > $credits)
                                <div class="totals"><p class="red-olsx-text">{{__('Credits Remained')}}<small><span id="required-credits1">{{ Auth::user()->credits->sum('credits') - $credits  }}</span> credits</small></p></div>
                            @else
                                <div class="totals"><p class="red-olsx-text">{{__('Credits To Buy')}}<small><span id="to-buy-credits">@if(Auth::user()->credits->sum('credits') > $credits){{ Auth::user()->credits->sum('credits') - $credits  }}@else {{ $credits -  Auth::user()->credits->sum('credits') }} @endif</span> credits</small></p></div>
                            @endif
                        </div>
                        <input type="hidden" id="total_credits_to_submit" name="total_credits_to_submit" value={{ $credits }}>
                        <div class="center">
                            @if( Auth::user()->credits->sum('credits') > $credits )
                            <form method="POST" action="{{ route('add-credits-to-file'); }}">
                                @csrf
                                <input type="hidden" name="credits" value={{ $credits }}>
                                <input type="hidden" name="file_id" value={{ $file->id }}>
                                <button class="btn-large btn-red " type="submit">
                                    {{__('Submit File')}}
                                </button>
                            </form>
                            @else 
                                @if( $credits - Auth::user()->credits->sum('credits') == 0 )
                                    <form method="POST" action="{{ route('add-credits-to-file'); }}">
                                        @csrf
                                        <input type="hidden" name="credits" value={{ $credits }}>
                                        <input type="hidden" name="file_id" value={{ $file->id }}>
                                        <button class="btn-large btn-red " type="submit">
                                            {{__('Submit File')}}
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                
                @if( Auth::user()->credits->sum('credits') < $credits )
                        

                    <div class="col s12 m6 l4 xl3">
                        <div class="card">
                            <div class="card-image reseller-bg" style="background-image: url('https://resellers.ecutech.tech/assets/img/ecutech/logo_white.png')">
                                <div class="card-title">
                                    <span class="number" id="credits-buying">{{$credits - Auth::user()->credits->sum('credits')}}</span>
                                    <span class="description">Tuning credit (reseller)</span>
                                </div>
                            </div>
                            <div class="card-content">
                                <input type="hidden" id="price_per_unit" value="{{$price->value}}" />
                                <input type="hidden" id="factor" value="{{$factor}}" />
                                <input type="hidden" id="tax" value="{{$tax}}" />
                                {{-- <span class="price-title-new">{{$price->value}} €</span> --}}
                                <span class="price-title-new">{{($credits - Auth::user()->credits->sum('credits'))*($price->value+$factor)}} €</span>
                                <span class="price-title-description">({{__('Original Price')}})</span>
                            </div>
                            <div class="card-action center">
                                <button id="show-cart" class="btn btn-red waves-effect waves-light m-sm">
                                    {{__('Buy')}}
                                </button>
                            </div>
                        </div>

                    </div>


                        
                   
                    @endif
                </div>
                    </div>
                </div>
            
    </main>

    <div id="modalcheckout" class="modal bottom-sheet" style="z-index: 1011; opacity: 1; bottom: 0px;">
        <input type="hidden" id="stripe-publishable-key" value="{{ env('STRIPE_KEY') }}">
        <div class="modal-header">
        <div class="row m-n">
            <div class="container">
                <div class="col s11">
                    <h4 class="shades-text text-white">{{__('Checkout')}}</h4>
                </div>
                <div class="col s1">
                    <a href="#!" class="modal-close" id="cart-close">
                            <span aria-hidden="true">
                                <div class="close-icon">
                                    <span></span>
                                    <span></span>
                                </div>
                            </span>
                    </a>
                </div>
            </div>
        </div>
        </div>
          <div class="modal-content">
        <div class="row">
            <div class="container">
                <div class="col s12 m8">
                    <ul class="collapsible popout" data-collapsible="accordion">
                        <li class="active">
                            <div class="collapsible-header active" id="cartCollapsible"><i class="fa fa-shopping-cart"></i>Cart</div>
                            <div class="collapsible-body collapsible-checkout " style="display: block;">
                                <table class="table" id="bagItemsTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('Item')}}</th>
                                            <th>{{__('Unit Price')}}</th>
                                            <th>{{__('Qty')}}</th>
                                              <th></th>
                                        </tr>
                                    </thead>
                                    <tbody><tr><td>1 Tuning credit (reseller)</td><td>{{$price->value}}€</td><td><input id="qty-input" name="qty-input" class="qty-input" min="1" type="number"></td><td><button type="button" id="remove-item" class="btn btn-flat tooltipped" data-position="top" data-tooltip="Remove item"><i class="fa fa-trash"></i></button></td></tr></tbody>
                                </table>
                            </div>
                        </li>
                        <li class="active">
                            <div class="collapsible-header"><i class="fa fa-person"></i>{{__('Billing Information')}}</div>
                            <div class="collapsible-body collapsible-checkout " style="display: block;">
                                <div class="row">
                                    <div class="col s6 ">
                                        <h6>{{__('Billing Address')}}:</h6>
                                        <address>
                                            <strong>{{ Auth::user()->company }}</strong><br>
                                            {{ Auth::user()->name }}<br>
                                            {{ Auth::user()->address }}<br>
                                            {{ code_to_country(Auth::user()->country) }}<br>
                                            @if($group)															
                                                {{$group->name}} ({{$group->tax}}%)
                                            @endif
                                            <br>
                                        </address>
                                    </div>
                                    <div class="col s6 ">&nbsp;</div>
                                </div>
                            </div>
                        </li>
                        <li class="active">
                            <div class="collapsible-header active" onclick="didClickOnPayment(event);"><i class="fa fa-dollar"></i>{{__('Payment')}}</div>
                            <div class="collapsible-body collapsible-checkout " style="display: block;">
                                <div class="row">
                                    <div class="card-payment col s12 m4">
                                        <div class="card-content">
                                            <h2>Stripe</h2>
                                            <ul class="payments">
                                                <li><img src="https://resellers.ecutech.tech/assets/img/payments/visa.svg" alt="Visa"></li>
                                                <li><img src="https://resellers.ecutech.tech/assets/img/payments/mastercard.svg" alt="Mastercard"></li>
                                                <li><img src="https://resellers.ecutech.tech/assets/img/payments/amex.svg" alt="American Express"></li>
                                                <li><img src="https://resellers.ecutech.tech/assets/img/payments/bancontact.svg" alt="Bancontact"></li>
                                                <li><img src="https://resellers.ecutech.tech/assets/img/payments/alipay.svg" alt="Alipay"></li>
                                                <li><img src="https://resellers.ecutech.tech/assets/img/payments/wechatpay.svg" alt="Wechat pay"></li>
                                                <li><img src="https://resellers.ecutech.tech/assets/img/payments/ideal.svg" alt="Ideal"></li>
                                                <li><img src="https://resellers.ecutech.tech/assets/img/payments/sofort.svg" alt="Klarna-Sofort"></li>
                                            </ul>
                                            <p>{{__('When validating your payment you will automatically be redirected to the Stripe website where you will be able to pay the amount due very easily.')}}</p>
                                        </div>
                                        <div class="card-action center">
                                            <form action="{{route('checkout-file')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="total_for_checkout" value="" id="total_for_checkout">
                                                <input type="hidden" name="credits_for_checkout" value="" id="credits_for_checkout">
                                                <input type="hidden" name="unit_price_for_checkout" value="" id="unit_price_for_checkout">
                                                <input type="hidden" name="file_id" value="{{$file->id}}" id="file_id">
                                                <input type="hidden" id="total_credits_to_submit" name="total_credits_to_submit" value={{ $credits }}>
                                                <button class="btn btn-red" type="submit">{{__('Pay with card')}}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col s12 m4">
                    <ul class="collapsible popout">
                        <li class="active">
                            <div class="collapsible-header active"><i class="fa fa-calculator m-r-sm"></i>{{__('Your order')}}</div>
                            <div class="collapsible-body collapsible-checkout" style="display: block;">
                                <table class="table invoice-total">
                                <tbody>
                                    <tr>
                                        <td><strong>{{__('Subtotal')}} :</strong></td>
                                        <td>€<span id="subTotal"></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{__('Adjustment')}} :</strong></td>
                                        <td>€<span id="vatSubTotal"></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{__('Tax')}} :</strong></td>
                                        <td>€<span id="taxValue"></span></td>
                                    </tr>
                                    <tr>
                                        <td><h6>{{__('Total Order')}} :</h6></td>
                                        <td><h6>€<span id="total"></span></h6></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
          </div>
          
    </div>
@endsection

@section('pagespecificscripts')

<script type="text/javascript">

function roundToTwo(value) {
    return(Math.round(value * 100) / 100);
}

$( document ).ready(function(event) {

    sessionStorage.setItem("Page2Visited", "True");

    $(document).on('click','.modal-close-payment', function(e){
        $(function () {
            $('#payment-modal').css("display", "none");
        });   
   });


   
    $(document).on('change','#qty-input', function(e){

        let qty = $(this).val();
        let price = $('#price_per_unit').val();
        let factor = $('#factor').val();
        let tax = $('#tax').val();

        // console.log(price);
        $('#subTotal').text(roundToTwo(qty*price));
        $('#vatSubTotal').text(roundToTwo(qty*factor));

        let adjustedPrice = (qty*price) + (qty*factor);
        let taxAmount = ( tax * adjustedPrice ) / 100;

        let adjusted_unit_price = roundToTwo(price) + roundToTwo(factor);
        let unit_price_tax = ( roundToTwo(tax) * roundToTwo(adjusted_unit_price) ) / 100;

        let final_unit_price = roundToTwo(adjusted_unit_price + unit_price_tax);

        console.log(adjustedPrice);

        console.log(adjusted_unit_price);

        $('#taxValue').text(roundToTwo(taxAmount));
        $('#total').text(roundToTwo(adjustedPrice + taxAmount));

        $('#total_for_checkout').val(roundToTwo(adjustedPrice + taxAmount));
        $('#credits_for_checkout').val(qty);
        $('#unit_price_for_checkout').val(final_unit_price);

    });

    $(document).on('click','#show-cart', function(e){
        let required_credits = parseInt( $('#credits-buying').text() );
        $('#qty-input').val(required_credits);
        let price = $('#price_per_unit').val();
        let factor = $('#factor').val();
        let tax = $('#tax').val();
        console.log(tax);
        
        console.log(price);
        $('#subTotal').text(roundToTwo(required_credits*price));
        $('#vatSubTotal').text(roundToTwo(required_credits*factor));

        let adjustedPrice = (required_credits*price) + (required_credits*factor);
        let taxAmount = ( tax * adjustedPrice ) / 100;

        let adjusted_unit_price = roundToTwo(price) + roundToTwo(factor);
        let unit_price_tax = ( roundToTwo(tax) * roundToTwo(adjusted_unit_price) ) / 100;

        let final_unit_price = roundToTwo(adjusted_unit_price + unit_price_tax);

        $('#taxValue').text(roundToTwo(taxAmount));
        $('#total').text(roundToTwo(adjustedPrice + taxAmount));

        $('#total_for_checkout').val(roundToTwo(adjustedPrice + taxAmount));
        $('#credits_for_checkout').val(required_credits);
        $('#unit_price_for_checkout').val(final_unit_price);

        $('#modalcheckout').css("display", "block");
    });

    $(document).on('click','#remove-item', function(e){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "/clear_cart",
                type: "GET",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your row has been deleted.",
                        type: "success",
                        timer: 3000
                    });

                    location.reload();
                }
            });            
        }
        })
   });

   $(document).on('click','#cart-close', function(e){
        $(function () {
            $('#modalcheckout').css("display", "none");
        });   
   });

});

</script>

@endsection
