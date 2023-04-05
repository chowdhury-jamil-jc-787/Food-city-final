<x-frontend.layouts.master>

@push('css')
<link href="{{ asset('ui/frontend/custom/buy.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

@endpush



<main class="page">
	<form action="/stripe" method="GET">
	 	<section class="shopping-cart dark">
	 		<div class="container">
		        <div class="block-heading">
		          <h2>Shopping Cart</h2>
		          </div>
		        <div class="content">
	 				<div class="row">
	 					<div class="col-md-12 col-lg-8">
	 						<div class="items">
				 				<div class="product">
				 					<div class="row">
									 <div class="col-md-3 ml-10">
    <img class="img-fluid mx-auto d-block image" src="{{ asset('storage/products/').'/'.$product->image }}">
</div>
					 					<div class="col-md-8">
					 						<div class="info">
						 						<div class="row">
							 						<div class="col-md-5 product-name">
							 							<div class="product-name">
								 							<a href="#">{{ $product->name }}</a>
								 							<div class="product-info">
									 							<div>Description: <span class="value">{{ $product->description }}</span></div>
									 							<div>Category: <span class="value">{{ $product->category->title }}</span></div>
                                                                <div>Size:           
@if ($size == 'S')
<span class="badge bg-info text-white">Small</span>

@elseif ($size == 'M')
<span class="badge bg-info text-white">Medium</span>

@elseif ($size =='F')
<span class="badge bg-info text-white">Family</span>
@endif</div>
									 							
									 						</div>
									 					</div>
							 						</div>



													
													 <div class="col-md-4 quantity">
    <label for="quantity">Quantity:</label>
    <input id="quantity" type="number" value="{{ $quantity }}" disabled class="form-control quantity-input">
</div>
<div class="col-md-3 price">
    <span id="price">৳{{ $result }}</span>
</div>


   
							 					</div>
							 				</div>
					 					</div>
					 				</div>
				 				</div>


				 			</div>
			 			</div>
			 			<div class="col-md-12 col-lg-4">
						 <div class="summary">
    <h3>Summary</h3>
    <div class="summary-item quantity">
        <span class="text">Subtotal</span>
        <div class="price">
            <span>৳{{ $result }}</span>
        </div>
    </div>
    <div class="summary-item discount">
        <span class="text">Discount</span>
        <span class="price">৳0</span>
    </div>
    <div class="summary-item shipping">
        <span class="text">Shipping</span>
        <span class="price">৳0</span>
    </div>
    <div class="summary-item total">
        <span class="text">Total</span>
        <span class="price">৳{{ $result }}</span>
    </div>

	<!-- Checkout modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Select Payment Option</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please select your preferred payment option:</p>
        <!-- Payment options -->
		<button type="button" class="btn btn-primary btn-lg btn-block" onclick="updatePrices(); window.location.href='/stripe?amount={{ $result+100 }}&quantity={{ $quantity }}&product_id={{ $product->id }}&user_id={{ Auth::id() }}&size={{ $size }}'">Pay with Stripe</button>
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="updatePrices(); window.location.href='/example1?amount={{ $result+100 }}&quantity={{ $quantity }}&product_id={{ $product->id }}&user_id={{ Auth::id() }}&size={{ $size }}'">Pay with SSL Commerz</button>
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="updatePrices(); window.location.href='/invoice?amount={{ $result+100 }}&quantity={{ $quantity }}&product_id={{ $product->id }}&user_id={{ Auth::id() }}&size={{ $size }}'">Cash on Delivery</button>
      </div>
    </div>
  </div>
</div>

<script>
const quantityInput = document.getElementById('quantity');
const priceElement = document.getElementById('price');
const subTotalElement = document.querySelector('.summary-item.quantity .price');
const discountElement = document.querySelector('.summary-item.discount .price');
const shippingElement = document.querySelector('.summary-item.shipping .price');
const totalElement = document.querySelector('.summary-item.total .price');

const pricePerItem = parseFloat('{{ $product->price }}');
let quantity = parseInt(quantityInput.value);

function updatePrices() {
    const subTotal = quantity * pricePerItem;
    const discount = 0;
    const shipping = 100;
    const total = subTotal - discount + shipping;

    priceElement.textContent = `৳${subTotal.toFixed(2)}`;
    subTotalElement.textContent = `৳${subTotal.toFixed(2)}`;
    discountElement.textContent = `৳${discount.toFixed(2)}`;
    shippingElement.textContent = `৳${shipping.toFixed(2)}`;
    totalElement.textContent = `৳${total.toFixed(2)}`;
}

quantityInput.addEventListener('change', () => {
    quantity = parseInt(quantityInput.value);
    updatePrices();
});

updatePrices();
</script>
<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#checkoutModal">Checkout</button>
</div>


</form>




			</div>
		 			</div> 
		 		</div>
	 		</div>
		</section>
	</main>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



</x-frontend.layouts.master>