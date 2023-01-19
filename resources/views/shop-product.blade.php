@extends('layouts.app')

@section('pagespecificstyles')
<style>

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

<div id="payment-modal" class="modal bottom-sheet" style="z-index: 1011; opacity: 1; bottom: 0px;">

    <div class="modal-header">
        <div class="row m-n">
            <div class="container">
                <div class="col s10">
                    <h4 class="shades-text text-white">Payment</h4>
                </div>
                <div class="col s2">
                    <a href="#" class="modal-close-payment">
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
                <div class="container m-t-20">
                    <div class="">
                        <div class="text-center">
                            <p id="errors" style="color:red;"></p>
                            <form action="{{route('payment-process')}}" id="stripe" method="post">
                                <input id="card-holder-name" placeholder="Card Holder Name" type="text">
                                
                                <!-- Stripe Elements Placeholder -->
                                <div id="card-element"></div>
                                <input name="pmethod" type="hidden" id="pmethod" value="" />
                                <input name="amount" type="hidden" id="amount" value="" />
                                <input name="credits" type="hidden" id="credits" value="" />
                                <button id="card-button">
                                    Process Payment
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<main>
    <div class="container">
        <div class="row">
			<div class="col s7 m8 l8">
				<h1>{{__('Shop')}}</h1>
			</div>
			<div class="col s5 m4 l4 center">
				<button class="btn btn-red waves-effect waves-light modal-trigger right btn-vehicle-id" href="#modalcheckout" id="showModalCheckout" style="z-index: 1009; top:20px;"><span>{{__('Cart')}} (<span class="count-info" id="bagCount">{{ \Cart::getTotalQuantity() }}</span>)</span>
					<i class="fa fa-shopping-cart right"></i>
                </button>
			</div>
		</div>
        <div class="ecu-panel active" id="title-credits">
			<div class="form-pad">
				<div class="row">
					<div class="col s12">
						<h1>Credits</h1>
					</div>
				</div>
				<div class="row">
                    <div class="col s12 m6 l4 xl3">
                        <div class="card">
                            <div class="card-image reseller-bg" style="background-image: url('https://resellers.ecutech.tech/assets/img/ecutech/logo_white.png')">
                                <div class="card-title">
                                    <span class="number">1</span>
                                    <span class="description">Tuning credit (reseller)</span>
                                </div>
                            </div>
                            <div class="card-content">
                                <input type="hidden" id="price_per_unit" value="{{$price->value}}" />
                                <input type="hidden" id="factor" value="{{$factor}}" />
                                <input type="hidden" id="tax" value="{{$tax}}" />
                                <span class="price-title-new">{{$price->value}} €</span>
                                <span class="price-title-description">({{__('Original Price')}})</span>
                            </div>
                            <div class="card-action center">
                                <button id="addToCart" class="btn btn-red waves-effect waves-light m-sm" data-toggle="modal" data-target="#modalAddToCart">
                                    {{__('Add to cart')}}
                                </button>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
    <div>
        
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
						<div class="collapsible-header active" id="cartCollapsible"><i class="fa fa-shopping-cart"></i>{{__('Cart')}}</div>
						<div class="collapsible-body collapsible-checkout " style="display: block;">
							<table class="table" id="bagItemsTable">
								<thead>
									<tr>
										<th>{{__('Item')}}</th>
										<th>{{__('Unit price')}}</th>
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
                                        {{$group->name}} ({{$group->tax}}%)<br>
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
                                        <button class="btn btn-red" id="pay">{{__('Pay with card')}}</button>
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

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');

    // Pass the appearance object to the Elements instance
    const elements = stripe.elements();

    // const elements = stripe.elements();
    // const cardElement = elements.create('card');

    /**
   * Card Element
   */
  var cardElement = elements.create('card', {
    iconStyle: 'solid',
    style: {
      base: {
        iconColor: '#f02429',
        color: '#f02429',
        fontWeight: 500,
        fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
        fontSize: '16px',
        fontSmoothing: 'antialiased',
        border: '1px solid grey',

        ':-webkit-autofill': {
          color: '#000000',
        },
        '::placeholder': {
          color: '#000000',
        },
      },
      invalid: {
        iconColor: '#f02429',
        color: '#f02429',
      },
    },
  });

    cardElement.mount('#card-element');
    const cardHolderName = document.getElementById('card-holder-name');
    const form = document.getElementById('stripe');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );
        if (error) {
            document.getElementById('errors').innerHTML = error.message;
            // Display "error.message" to the user...
        } else {
            console.log('Card verified successfully');
            console.log(paymentMethod.id);
            document.getElementById('pmethod').setAttribute('value', paymentMethod.id);
            document.getElementById('amount').setAttribute('value', $('#total').text() );
            document.getElementById('credits').setAttribute('value', $('#qty-input').val() );
            form.submit();
        }
    });
</script>

<script type="text/javascript">

$( document ).ready(function(event) {
    
    $(document).on('change','#qty-input', function(e){
        
            let qty = $(this).val();
            let price = $('#price_per_unit').val();
            let factor = $('#factor').val();
            let tax = $('#tax').val();

            console.log(price);
            $('#subTotal').text(roundToTwo(qty*price));
            $('#vatSubTotal').text(roundToTwo(qty*factor));

            let adjustedPrice = (qty*price) + (qty*factor);
            let taxAmount = ( tax * adjustedPrice ) / 100;

            console.log(adjustedPrice);

            $('#taxValue').text(roundToTwo(taxAmount));
            $('#total').text(roundToTwo(adjustedPrice + taxAmount));
    });

    // $(document).on('click','#remove-item', function(e){

    // });

    $(document).on('click','#showModalCheckout', function(e){
        get_update_show_cart();
    });

    $(document).on('click','#addToCart', function(e){
       console.log('add to cart btn clicked');

       $.ajax({
            url: "/add_to_cart",
            type: "POST",
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: {
                cart: 1
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                icon: 'success',
                title: '1 Tuning credit (reseller)',
                text: '{{__('Successfully added to Cart')}}',
                showDenyButton: true,
                denyButtonText: '{{__('Continue Shopping')}}',
                confirmButtonText: '{{__('Go to Cart')}}',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    get_update_show_cart();
                } else if (result.isDenied) {
                    location.reload();
                }
            });
            }
        }); 
    });

    function roundToTwo(value) {
        return(Math.round(value * 100) / 100);
    }

    function get_update_show_cart(){

        $.ajax({
            url: "/cart_quantity",
            type: "POST",
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: {},
            success: function(qty) {
                $('#qty-input').val(qty);
                let price = $('#price_per_unit').val();
                let factor = $('#factor').val();
                let tax = $('#tax').val();

            console.log(price);
            $('#subTotal').text(roundToTwo(qty*price));
            $('#vatSubTotal').text(roundToTwo(qty*factor));

            let adjustedPrice = (qty*price) + (qty*factor);
            let taxAmount = ( tax * adjustedPrice ) / 100;

            console.log(adjustedPrice);

            $('#taxValue').text(roundToTwo(taxAmount));
            $('#total').text(roundToTwo(adjustedPrice + taxAmount));

            $('#modalcheckout').css("display", "block");

            }
        });
    }

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

   $(document).on('click','#continueShopping', function(e){
        if($('.modal-overlay').css('display') == 'block'){
            console.log('closed');
            $('.modal-overlay').css("display", "none");
        }
   });

   $(document).on('click','#cart-close', function(e){
        $(function () {
            $('#modalcheckout').css("display", "none");
        });   
   });

   $(document).on('click','.modal-close-payment', function(e){
        $(function () {
            $('#payment-modal').css("display", "none");
        });   
   });

    $(document).on('click','#pay', function(e){

        $(function () {
            $('#modalcheckout').css("display", "none");
        }); 

        $('#payment-modal').css("display", "block");

        console.log('pay button clicked');
    });

        // console.log('pay button clicked');
        // $('#payment_stripe_modal').modal('show');

        // $('#payment_stripe_modal').css("display", "block");
        // Swal.fire({
        // title: '{{__('Payment Details')}}',
        // html: `<input type="text" value="" id="cardname" class="swal2-input" placeholder="Card Name">
        // <input type="text" value="" id="cardnumber" class="swal2-input" placeholder="Card Number">
        // <div class="row-form"><input value="" type="text" id="cvc" class="swal2-input" placeholder="CVC"><input value="" type="text" id="expiry_month" class="swal2-input" placeholder="Expiry Month"><input value="" type="text" id="expiry_year" class="swal2-input" placeholder="Expiry Year"></div>`,
        
        // confirmButtonText: '{{__('Pay')}}',
        // focusConfirm: false,
        // preConfirm: () => {
        //     const cardname = Swal.getPopup().querySelector('#cardname').value
        //     const cardnumber = Swal.getPopup().querySelector('#cardnumber').value
        //     const cvc = Swal.getPopup().querySelector('#cvc').value
        //     const expiry_month = Swal.getPopup().querySelector('#expiry_month').value
        //     const expiry_year = Swal.getPopup().querySelector('#expiry_year').value
        //     if (!cardname || !cardnumber || !cvc || !expiry_month || !expiry_year) {
        //         Swal.showValidationMessage(`Fill All the Fields`)
        //     }
        //     return { cardname: cardname, cardnumber: cardnumber, cvc:cvc, expiry_month:expiry_month, expiry_year:expiry_year }
        // }
        // }).then((result) => {

            

        //     let values = result.value;
           
        //     Stripe.setPublishableKey($('#stripe-publishable-key').val());
        //     Stripe.createToken({
        //     number:Swal.getPopup().querySelector('#cardnumber').value,
        //     cvc: Swal.getPopup().querySelector('#cvc').value,
        //     exp_month: Swal.getPopup().querySelector('#expiry_month').value,
        //     exp_year: Swal.getPopup().querySelector('#expiry_year').value
        //   }, function(s,e) {

        //       console.log(e);
        //       values['stripeToken'] = e.id;
        //       values['total'] = $('#total').text();
        //       values['credits'] = $('#qty-input').val();

        //       $.ajax({
        //             url: "/make_payment",
        //             type: "POST",
        //             headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        //             data: values,
        //             success: function(response) {
        //                 Swal.fire({
        //                     icon: 'success',
        //                     title: 'Payment Accepted',
        //                     text: 'Your Payment is successful',
        //                     timer: 3000
        //                 });
        //                 location.reload();
        //             },
        //             error: function (xhr, status, error) {
        //                 let err = JSON.parse(xhr.responseText);
        //                 console.log(err);
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title:'Payment Not Successful',
        //                     text: err.error,
        //                 });
        //             }

        //         });
        //     });
        // });

    // });

});

</script>

@endsection
