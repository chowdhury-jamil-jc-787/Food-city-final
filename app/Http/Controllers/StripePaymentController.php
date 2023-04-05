<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe(Request $request)
    {
        $product = Product::find($request->input('product_id'));
        $user = User::find($request->input('user_id'));
        $id = $request->input('user_id');
        $profile = Profile::where('user_id', $id)->first();
        $amount = $request->input('amount');
        $size = $request->input('size');
        $quantity = $request->input($request->input('quantity'));
        return view('frontend.stripe', compact('product','user','amount','quantity','profile','size'));
    }

    public function stripePost(Request $request)
{

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
    $customer = Stripe\Customer::create(array(
            "address" => [
                "line1" => "Virani Chowk",
                "postal_code" => "390008",
                "city" => "Vadodara",
                "state" => "GJ",
                "country" => "IN",
            ],
            "email" => $request->input('customer_email'),
            "name" => $request->input('customer_name'),
            "source" => $request->stripeToken
        ));
    Stripe\Charge::create ([
            "amount" => 100 * 100,
            "currency" => "usd",
            "customer" => $customer->id,
            "description" => "Test payment from Foodcity",
            "shipping" => [
                "name" => "Jenny Rosen",
                "address" => [
                    "line1" => "510 Townsend St",
                    "postal_code" => "98140",
                    "city" => "San Francisco",
                    "state" => "CA",
                    "country" => "US",
                ],
            ]
    ]); 

    $order = new Order;
    $post_data['total_amount'] = $request->input('amount');
    $post_data['cus_name'] = $request->input('customer_name');
    $post_data['cus_email'] = $request->input('customer_email');
    $post_data['cus_add1'] = $request->input('address');
    $post_data['cus_phone'] = $request->input('customer_mobile');
    $post_data['product_id'] = $request->input('product_id');
    $post_data['size'] = $request->input('size');
    $post_data['tran_id'] = uniqid();
    $post_data['currency'] = "BDT";
    $data = [
        'name' => $post_data['cus_name'],
        'email' => $post_data['cus_email'],
        'phone' => $post_data['cus_phone'],
        'amount' => $post_data['total_amount'],
        'status' => 'Pending',
        'address' => $post_data['cus_add1'],
        'transaction_id' => $post_data['tran_id'],
        'currency' => $post_data['currency'],
        'product_id' =>$post_data['product_id'],
        'size' =>$post_data['size'],
    ];

    $order->create($data);
    Session::flash('success', 'Payment successful!');
    return back();
}
}
