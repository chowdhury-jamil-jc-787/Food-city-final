<x-frontend.layouts.master>

@push('css')

<link href="{{ asset('ui/frontend/custom/checkout.css') }}" rel="stylesheet">


@endpush


<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2>Shopping Cart</h2>
        </div>
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                    <th class="text-right py-3 px-4" style="width: 100px;"></th>
                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($carts as $cart)
                  <tr>
                    <td class="p-4">
                      <div class="media align-items-center">
                        <img src="{{ asset('storage/products/').'/'.$cart->product->image }}" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                        <div class="media-body">
                          <a href="#" class="d-block text-dark">{{ $cart->product->name }}</a>
                          <small>
                            <span class="text-muted">Size: </span> @if ($cart->size == 1)
<span class="badge bg-info text-white">Small</span>

@elseif ($cart->size == 2)
<span class="badge bg-info text-white">Medium</span>

@elseif ($cart->size ==3)
<span class="badge bg-info text-white">Family</span>
@endif &nbsp;
                            <span class="text-muted">Ships from: </span> Dhaka
                          </small>
                        </div>
                      </div>
                    </td>
                    <td class="text-right font-weight-semibold align-middle p-4">৳{{ $cart->product->price }}</td>
                    <form action="/cart/update/{{ $cart->user_id }}/{{ $cart->product_id }}" method="get">
                    <td class="align-middle p-4"><input type="number" name="quantity" class="form-control text-center" value="{{ $cart->quantity }}"></td>
                    <td class="text-right font-weight-semibold align-middle p-4">৳{{ $cart->amount }}</td>
                    <td class="text-center align-middle px-0"><a href="/cart/delete/{{ $cart->user_id }}/{{ $cart->product_id }}" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
                    <td class="text-right font-weight-semibold align-middle p-4"><button type="submit" class="btn btn-primary">Update</button>
</td>
                    </form>
                  </tr>
                  @endforeach
     
                </tbody>
              </table>
            </div>
            <!-- / Shopping cart table -->
            @php
$total_price = 0;
foreach($carts as $cart) {
    $total_price += $cart->amount;
}
@endphp
        
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4">
                <label class="text-muted font-weight-normal">Promocode</label>
                <input type="text" placeholder="ABC" class="form-control">
              </div>
              <div class="d-flex">
                <div class="text-right mt-4 mr-5">
                  <label class="text-muted font-weight-normal m-0">Discount</label>
                  <div class="text-large"><strong>$20</strong></div>
                </div>
                <div class="text-right mt-4">
                  <label class="text-muted font-weight-normal m-0">Total price</label>
                  <div class="text-large"><strong>${{ $total_price }}</strong></div>
                </div>
              </div>
            </div>
        
            <div class="float-right">
            <a href="/" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">Back to shopping</a>
              <button type="button" class="btn btn-lg btn-primary mt-2">Checkout</button>
            </div>
        
          </div>
      </div>
  </div>
</x-frontend.layouts.master>