<x-frontend.layouts.master>
<!-- Carousel Start -->
<x-frontend.layouts.partials.home.carousel :images="$images" />
    <!-- Carousel End -->


    <!-- Featured Start -->
    <x-frontend.layouts.partials.home.featured/>
    <!-- Featured End -->


    <!-- Categories Start -->
 
    <x-frontend.layouts.partials.home.categories :categories="$categories" />
    
    <!-- Categories End -->


    <!-- Products Start -->
    <x-frontend.layouts.partials.home.featuredProducts :products="$products" />
    <!-- Products End -->


    <!-- Offer Start -->
    <x-frontend.layouts.partials.home.offer/>
    <!-- Offer End -->


    <!-- Products Start -->
    <x-frontend.layouts.partials.home.recentProducts/>
    <!-- Products End -->


    <!-- Vendor Start -->
    <x-frontend.layouts.partials.home.vendor/>
    <!-- Vendor End -->

  
    
</x-frontend.layouts.master>