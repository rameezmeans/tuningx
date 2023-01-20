<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends Controller
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


    public function success_file(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            dd($session);

            if (!$session) {
                throw new NotFoundHttpException;
            }

            $customer = \Stripe\Customer::retrieve($session->customer);

            $creditsBought = $request->credits;

            $credit = new Credit();
            $credit->credits = $creditsBought;
            $credit->user_id = Auth::user()->id;
            $credit->stripe_id = $sessionId->id;
            $credit->price_payed = $request->amount;
            $credit->invoice_id = 'INV-'.mt_rand(1000,9999);
            $credit->save();

            \Cart::remove(101);

        return redirect()->route('shop-product', ['success' => 'Credits purchased!']);

            // return view('product.checkout-success', compact('customer'));

        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

    }

    public function cancel()
    {

    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id'); 

        try {

            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            if (!$session) {
                throw new NotFoundHttpException;
            }
            
            $customer = \Stripe\Customer::retrieve($session->customer);

            $creditsBought = $request->credits;

            $credit = new Credit();

            $credit->credits = $creditsBought;
            $credit->user_id = Auth::user()->id;
            $credit->stripe_id = $session->id;
            $credit->price_payed = $request->unit_price * $creditsBought;
            $credit->invoice_id = 'INV-'.mt_rand(1000,9999);
            $credit->save();

            \Cart::remove(101);

        return redirect()->route('shop-product', ['success' => 'Credits purchased!']);

        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

    }


    public function checkout(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];
        
        $lineItems[] = [
          'price_data' => [
              'currency' => 'eur',
              'product_data' => [
                'name' => "Tuning Credit(s)"
            ],
              'unit_amount' => $request->unit_price_for_checkout * 100,
          ],
          'quantity' => $request->credits_for_checkout,
        ];
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}&credits=".$request->credits_for_checkout."&unit_price=".$request->unit_price_for_checkout,
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        return redirect($session->url);
    }


    public function checkout_file(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        dd($request->all());

        $lineItems = [];
        
        $lineItems[] = [
          'price_data' => [
              'currency' => 'eur',
              'product_data' => [
                'name' => "Tuning Credit(s)"
            ],
              'unit_amount' => $request->unit_price_for_checkout * 100,
          ],
          'quantity' => $request->credits_for_checkout,
        ];
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}&credits=".$request->credits_for_checkout."&unit_price=".$request->unit_price_for_checkout,
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        return redirect($session->url);

    }

    public function paymentAction(Request $request) {
      $user         = Auth::user();
      try {

          $amount = $request->amount;
          $stripeCharge = $user->charge( $amount*100, $request->pmethod);

      } catch (IncompletePayment $exception) {
          return redirect()->route(
              'cashier.payment',
              [$exception->payment->id, 'redirect' => route('shop-product')]
          );
      }

      if($stripeCharge->status == "succeeded"){

        $creditsBought = $request->credits;

        $credit = new Credit();
        $credit->credits = $creditsBought;
        $credit->user_id = Auth::user()->id;
        $credit->stripe_id = $stripeCharge->id;
        $credit->price_payed = $request->amount;
        $credit->invoice_id = 'INV-'.mt_rand(1000,9999);
        $credit->save();

        \Cart::remove(101);

        return redirect()->route('shop-product', ['success' => 'Credits purchased!']);
      }

         
  }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function makePayment(Request $request)
    {

        try{
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $payment = Stripe\Charge::create ([
                "amount" => $request->total*100,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Test payment from Rameez" 
        ]);

    } catch(\Stripe\Exception\CardException $e) {

        // Since it's a decline, \Stripe\Exception\CardException will be caught
        // echo 'Status is:' . $e->getHttpStatus() . '\n';
        // echo 'Type is:' . $e->getError()->type . '\n';
        // echo 'Code is:' . $e->getError()->code . '\n';
        // // param is '' in this case
        // echo 'Param is:' . $e->getError()->param . '\n';
        // echo 'Message is:' . $e->getError()->message . '\n';

        return response()->json(['error'=>$e->getError()->message], 500);

      } catch (\Stripe\Exception\RateLimitException $e) {
        return response()->json(['error'=>$e->getError()->message], 500);
      } catch (\Stripe\Exception\InvalidRequestException $e) {
        return response()->json(['error'=>$e->getError()->message], 500);
      } catch (\Stripe\Exception\AuthenticationException $e) {
        // Authentication with Stripe's API failed
        return response()->json(['error'=>$e->getError()->message], 500);
      } catch (\Stripe\Exception\ApiConnectionException $e) {
        // Network communication with Stripe failed
        return response()->json(['error'=>$e->getError()->message], 500);
      } catch (\Stripe\Exception\ApiErrorException $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        return response()->json(['error'=>$e->getError()->message], 500);
      } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
        return response()->json(['error'=>$e->getError()->message], 500);
      }

        $creditsBought = $request->credits;

        $credit = new Credit();
        $credit->credits = $creditsBought;
        $credit->user_id = Auth::user()->id;
        $credit->stripe_id = $payment->id;
        $credit->price_payed = $request->total;
        $credit->invoice_id = 'INV-'.mt_rand(1000,9999);
        $credit->save();

        \Cart::remove(101);
        return response()->json(['payment'=>$payment]);
    }

    public function getCart(){
        $item = \Cart::get(101);
        dd($item);
    }

    public function getCartQuantity(){
        $item = \Cart::get(101);
        if($item){
            return $item['quantity'];
        }
        else{
            return 0;
        }
    }

    public function clearCart(){
        \Cart::remove(101);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addToCart(Request $request)
    {

        $empty = \Cart::isEmpty();

        if($empty){

            $product = Product::findOrFail(1);
            $request->cart;

            \Cart::add(array(
                'id' => 101,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => array(),
                'associatedModel' => $product
            ));
        }

        else{

            \Cart::update(101, array(
                'quantity' => $request->cart, 
              ));
        }

        
        return response()->json(['success'=>'Item Added to cart']);
    }
}
