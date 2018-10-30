<?php

namespace App\Http\Controllers\Checkout;

use App\File;
use App\Http\Requests\Checkout\FreeCheckoutRequest;
use App\Jobs\Checkout\CreateSale;
use App\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function free(FreeCheckoutRequest $request, File $file)
    {
        if(!$file->isFree()) {
            return back();
        }
        
        dispatch(new CreateSale($file, $request->email));
        
        return back()->withSuccess('We\'ve email your download link to you.');
    }
    
    public function payment(Request $request, File $file)
    {
        try{
            
            $charge = Stripe::create([
                'amount' => $file->price * 100,
                'currency' => 'gbp',
                'source' => $request->stripeToken,
                'application_fee' => $file->calculateCommission() * 100
            ], [
                'stripe_account' => $file->user->stripe_id
            ]);
            
        }catch(\Exception $e) {
            return back()->withError('Something went wront while processing your payment.');
        }
    
        dispatch(new CreateSale($file, $request->stripeEmail));
        
        return back()->withSuccess('Payment complete. We\'ve email your download link to you.');
    }
}
