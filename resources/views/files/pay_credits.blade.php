@extends('layouts.app')

@section('pagespecificstyles')

<style>
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
                <div class="col s12 l4 m3">
                    <div class="target wow fadeInDownBig pinned" style="visibility: visible; top: 100px;">
                        <div class="brand-middle-panel hide-on-med-and-down">
                            <img src="{{ get_image_from_brand($file->brand) }}" alt="logo">
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
                                    <strong>You need to pay the Credits to submit the file.</strong>
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
                            <div class="totals"><p class="red-olsx-text">Credits Required <small><span id="total-credits">{{$credits}}</span> credits</small></p></div>
                            <div class="totals"><p class="red-olsx-text">Account Credits<small><span id="account-credits">{{ Auth::user()->credits->sum('credits') }}</span> credits</small></p></div>
                            <div class="totals"><p class="red-olsx-text">Credits needed<small><span id="required-credits">{{ $credits - Auth::user()->credits->sum('credits') }}</span> credits</small></p></div>
                        </div>
                        <input type="hidden" id="total_credits_to_submit" name="total_credits_to_submit">
                        <div class="center">
                            @if( $credits - Auth::user()->credits->sum('credits') == 0 )
                            <form method="POST" action="{{ route('add-credits-to-file'); }}">
                                @csrf
                                <input type="hidden" name="credits" value={{ $credits }}>
                                <input type="hidden" name="file_id" value={{ $file->id }}>
                                <button class="btn-floating btn-large waves-effect waves-light btn-red btn-middle-panel" type="submit">
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                        @if( $credits - Auth::user()->credits->sum('credits') > 0 )
                        <div class="col s12 m6 l4 xl3">
                        <div class="card">
                            <div class="card-image reseller-bg" style="background-image: url('https://resellers.ecutech.tech/assets/img/ecutech/logo_white.png')">
                                <div class="card-title">
                                    <span class="number">{{$credits - Auth::user()->credits->sum('credits')}}</span>
                                    <span class="description">Tuning credit (reseller)</span>
                                </div>
                            </div>
                            <div class="card-content">
                                <span class="price-title-new">{{($credits - Auth::user()->credits->sum('credits'))*10.0}} €</span>
                                <span class="price-title-description">(VAT Excluded)</span>
                            </div>
                            <div class="card-action center">
                                <button id="show-cart" class="btn btn-red waves-effect waves-light m-sm">
                                    Buy
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    </div>
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
                    <h4 class="shades-text text-white">Checkout</h4>
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
                                            <th>Item</th>
                                            <th>Unit price</th>
                                            <th>Qty</th>
                                              <th></th>
                                        </tr>
                                    </thead>
                                    <tbody><tr><td>1 Tuning credit (reseller)</td><td>12.40€</td><td><input id="qty-input" name="qty-input" class="qty-input" min="1" type="number"></td><td><button type="button" id="remove-item" class="btn btn-flat tooltipped" data-position="top" data-tooltip="Remove item"><i class="fa fa-trash"></i></button></td></tr></tbody>
                                </table>
                            </div>
                        </li>
                        <li class="active">
                            <div class="collapsible-header"><i class="fa fa-person"></i>Billing Information</div>
                            <div class="collapsible-body collapsible-checkout " style="display: block;">
                                <div class="row">
                                    <div class="col s6 ">
                                        <h6>Billing Address:</h6>
                                        <address>
                                            <strong>{{ Auth::user()->company }}</strong><br>
                                            {{ Auth::user()->name }}<br>
                                            {{ Auth::user()->address }}<br>
                                            {{ code_to_country(Auth::user()->country) }}<br>															
                                            VAT (24%)<br>
                                        </address>
                                    </div>
                                    <div class="col s6 ">&nbsp;</div>
                                </div>
                            </div>
                        </li>
                        <li class="active">
                            <div class="collapsible-header active" onclick="didClickOnPayment(event);"><i class="fa fa-dollar"></i>Payment</div>
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
                                            <p>When validating your payment you will automatically be redirected to the Stripe website where you will be able to pay the amount due very easily.</p>
                                        </div>
                                        <div class="card-action center">
                                            <a class="btn btn-red" id="pay">Pay with card</a>
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
                            <div class="collapsible-header active"><i class="fa fa-calculator m-r-sm"></i>Your order</div>
                            <div class="collapsible-body collapsible-checkout" style="display: block;">
                                <table class="table invoice-total">
                                <tbody>
                                    <tr>
                                        <td><strong>Subtotal :</strong></td>
                                        <td>€<span id="subTotal"></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>VAT :</strong></td>
                                        <td>€<span id="vatSubTotal"></span></td>
                                    </tr>
                                    <tr>
                                        <td><h6>Total Order :</h6></td>
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

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

$( document ).ready(function(event) {
    $(document).on('click','#show-cart', function(e){
                let required_credits = parseInt( $('#required-credits').text() );
                $('#qty-input').val(required_credits);
                $('#subTotal').text(required_credits*10);
                $('#vatSubTotal').text(required_credits*2.4);
                $('#total').text(required_credits*12.4);
                $('.modal').css("display", "block");
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
            $('.modal').css("display", "none");
        });   
   });

   $(document).on('click','#pay', function(e){
        console.log('pay button clicked');

        Swal.fire({
        title: 'Payment Details',
        html: `<input type="text" value="Test" id="cardname" class="swal2-input" placeholder="Card Name">
        <input type="text" value="4242424242424242" id="cardnumber" class="swal2-input" placeholder="Card Number">
        <div class="row-form"><input value="123" type="text" id="cvc" class="swal2-input" placeholder="CVC"><input value="12" type="text" id="expiry_month" class="swal2-input" placeholder="Expiry Month"><input value="2024" type="text" id="expiry_year" class="swal2-input" placeholder="Expiry Year"></div>`,
        
        confirmButtonText: 'Pay',
        focusConfirm: false,
        preConfirm: () => {
            const cardname = Swal.getPopup().querySelector('#cardname').value
            const cardnumber = Swal.getPopup().querySelector('#cardnumber').value
            const cvc = Swal.getPopup().querySelector('#cvc').value
            const expiry_month = Swal.getPopup().querySelector('#expiry_month').value
            const expiry_year = Swal.getPopup().querySelector('#expiry_year').value
            if (!cardname || !cardnumber || !cvc || !expiry_month || !expiry_year) {
                Swal.showValidationMessage(`Fill All the Fields`)
            }
            return { cardname: cardname, cardnumber: cardnumber, cvc:cvc, expiry_month:expiry_month, expiry_year:expiry_year }
        }
        }).then((result) => {

            

            let values = result.value;
           
            Stripe.setPublishableKey($('#stripe-publishable-key').val());
            Stripe.createToken({
            number:Swal.getPopup().querySelector('#cardnumber').value,
            cvc: Swal.getPopup().querySelector('#cvc').value,
            exp_month: Swal.getPopup().querySelector('#expiry_month').value,
            exp_year: Swal.getPopup().querySelector('#expiry_year').value
          }, function(s,e) {

              console.log(e);
              values['stripeToken'] = e.id;
              values['total'] = $('#total').text();
              values['credits'] = $('#qty-input').val();

              $.ajax({
                    url: "/make_payment",
                    type: "POST",
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    data: values,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Payment Accepted',
                            text: 'Your Payment is successful',
                            timer: 3000
                        });
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        let err = JSON.parse(xhr.responseText);
                        console.log(err);
                        Swal.fire({
                            icon: 'error',
                            title:'Payment Not Successful',
                            text: err.error,
                        });
                    }

                });
            });
        });

    });

});

</script>

@endsection
