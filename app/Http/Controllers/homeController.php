<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use PDF;
use App\Models\User;
use App\Models\Order;
use App\Models\Profile;
use App\Models\Image_slider;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class homeController extends Controller
{
    public function categories()
    {
        $images = Image_slider::latest()->get();
        $products = Product::latest()->get();
        $categories = Category::latest()->get();
        return view('frontend.home',compact('categories','products','images'));

    }
    public function details($id )
    {
        $product = Product::find($id);
        return view('frontend.details',compact('product'));
    }

    public function checkout(Request $request, $product_id, $user_id)
    {
        if ($request->has('buy')) {


            if (Auth::check()) {

                if($request->quantity>0){

                $product = Product::find($product_id);
                $quantity = $request->quantity;

                $size = $request->size;

                
                $result = $product->price*$quantity;

                return view('frontend.buy',compact('product','quantity','result','size'));
            }else{

                    return redirect()->back()->with('error', 'At least 1 item should be buy');
    
            }



        }

            else{ 
                return redirect()->route('login');
            }

        }

        else{

        if (Auth::check()) {

            if($request->quantity>0){

                $cart = Cart::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->first();

                if ($cart != null) {

            if($cart->product_id == $product_id)
            {
                
                if($request->size == 'S')
                {
                    $size = 1;
                }
                if($request->size == 'M')
                {
                    $size = 2;
                }
                if($request->size == 'F')
                {
                    $size = 3;
                }

                $unitPrice = Product::find($product_id);

                $quantity = ($cart->quantity + ($request->quantity)) * $unitPrice->price;

                if($_GET['quantity'] == 0){
    
                $cart->update([
                    'quantity' => $cart->quantity,
                    'size'=>$size,
                    'amount'=>$quantity,
                ]);
               }else{
                $cart->update([
                    'quantity' => $cart->quantity + ($request->quantity),
                    'size'=>$size,
                    'amount'=>$quantity,
                ]);

               }

               $product = Product::find($product_id);
               $user = User::find($user_id);

               $cart = Cart::where('user_id', $user_id)
               ->first();

               $cartsloop = Cart::with('product')->get();

               return redirect()->back()->with('success', 'Cart item has been added successfully');


            }}
            else{

            if($request->size == 'S')
            {
                $size = 1;
            }
            if($request->size == 'M')
            {
                $size = 2;
            }
            if($request->size == 'F')
            {
                $size = 3;
            }

            $unitPrice = Product::find($product_id);

            $quantity = ($request->quantity) * $unitPrice->price;


            Cart::create([
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'amount'=>$quantity,
                'quantity'=>$request->quantity,
                'size'=>$size,
    
            ]);
    
            $product = Product::find($product_id);
            $user = User::find($user_id);

            $cart = Cart::where('user_id', $user_id)
            ->first();

            $cartsloop = Cart::with('product')->get();

            return redirect()->back()->with('success', 'Cart item has been added successfully');
        }

            }
            else{

                return redirect()->back()->with('error', 'At least 1 item should be add');

            }


           
        } else {
            // The user is a guest
            return redirect()->route('login');
        }
    }

    }

    public function buy()
    {
        return view('frontend.buy');
    } 


    public function invoice(Request $request)
    {
        $id = $request->user_id;
        $user = User::find($id);
        $profile = Profile::where('user_id', $id)->first();
        $product_id = $request->product_id;
        $amount = $request->amount;
        $quantity = $request->quantity;
        if($request->size == 'S')
            {
                $size = 1;
            }
            if($request->size == 'M')
            {
                $size = 2;
            }
            if($request->size == 'F')
            {
                $size = 3;
            }

        $order = new Order;
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $profile->phone_number,
            'amount' => $amount,
            'status' => 'Unpaid',
            'address' => $profile->address,
            'transaction_id' => uniqid(),
            'currency' => 'BDT',
            'product_id' =>$product_id,
            'size' =>$size,
        ];
    
        $order->create($data);

        $product = Product::where('id', $product_id)->first();

        $quantity = $request->quantity;



        return view('frontend.invoice',compact('data','product','quantity'));
    
    }

    public function invoiceDownload($id,$product_id,$quantity)
    {
        $data = Order::where('transaction_id',$id)->first();
        $product = Product::where('id',$product_id)->first();
        $pdf = PDF::loadView('frontend.invoice', compact('data','product','quantity'));
        return $pdf->download('FoodCity.pdf');
    
    }
    public function productList($id)
    {
        $products = Product::where('category_id', $id)->get();
        return view('frontend.productlist',compact('products'));
    }
    public function cart($id)
    {
        $carts = Cart::where("user_id",$id)->get();
        return view('frontend.checkout',compact('carts'));

    }
    public function cartDelete(Request $request,$user_id,$product_id)
    {

        $cart = Cart::where('user_id', $user_id)
        ->where('product_id', $product_id)
        ->first();
        $cart->delete();
        return redirect()->back()->with('success', 'Cart item has been deleted successfully');

    }
    public function cartUpdate(Request $request,$user_id,$product_id)
    {

        dd($request->quantity);

        $cart = Cart::where('user_id', $user_id)
        ->where('product_id', $product_id)
        ->first();
        $cart->delete();
        return redirect()->back()->with('success', 'Cart item has been deleted successfully');

    }
}
