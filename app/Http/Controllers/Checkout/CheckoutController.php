<?php

namespace App\Http\Controllers\Checkout;

use App\File;
use App\Http\Requests\Checkout\FreeCheckoutRequest;
use App\Jobs\Checkout\CreateSale;
use App\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function free(FreeCheckoutRequest $request, File $file)
    {
        if(!$file->isFree()) {
            return back();
        }
        
        Dispatch(new CreateSale($file, $request->email));
        
        return back()->withSuccess('We\'ve email your download link to you.');
    }
}
