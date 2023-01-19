@extends('layouts.app')

@section('pagespecificstyles')

<style>
    .text-center {
        text-align: center !important;
    }

    .m-t-20{
        margin-top: 50px;
        width: 40% !important;
    }

    @media only screen and (max-width: 768px) {
         .m-t-20{
            margin-top: 50px;
            width: 90% !important;
        }
    }

    .m-t-20{
        margin-top: 50px;
        width: 40% !important;
    }
    
    

</style>

@endsection

@section('content')
<div id="" class="bottom-sheet" style="z-index: 1011; opacity: 1; bottom: 0px;">

<div class="modal-header">
	<div class="row m-n">
		<div class="container">
			<div class="col s10">
				<h4 class="shades-text text-white">Payment</h4>
			</div>
			<div class="col s2">
				<a href="{{route('shop-product')}}" class="modal-close">
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
            document.getElementById('amount').setAttribute('value', 100.00);
            form.submit();
        }
    });
</script>

@endsection