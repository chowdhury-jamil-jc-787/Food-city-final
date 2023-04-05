<div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        @foreach($images as $image)
                        <div class="carousel-item position-relative {{ $loop->first ? 'active' : '' }}" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="{{ asset('storage/Image_slider/').'/'.$image->image }}" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Easy Food Ordering</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Order food from local restaurants in seconds with Quick Bites - fast delivery and easy payment options included</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="https://media.istockphoto.com/id/1185865984/photo/hamburger-on-black-background-for-fast-food-restaurant-design-or-fast-food-menu.jpg?s=612x612&w=0&k=20&c=4zddQpCn5Tirvm3wcBUmtIf3TDpbFTfd_zSVllhHdZs=" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="https://img.freepik.com/premium-photo/hamburgers-served-black-background-burgers-with-different-fillings-fish-chicken-chickpeas_583887-3.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>