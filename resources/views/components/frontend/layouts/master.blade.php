<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FoodCity</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('ui/frontend/img/fav.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('ui/frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ui/frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('ui/frontend/css/style.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body>
    <!-- Topbar Start -->
    <x-frontend.layouts.partials.topbar/>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <x-frontend.layouts.partials.navbar/>
    <!-- Navbar End -->


    {{ $slot }}


    <!-- Footer Start -->
    <x-frontend.layouts.partials.footer/>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('ui/frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('ui/frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('ui/frontend/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('ui/frontend/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('ui/frontend/js/main.js') }}"></script>
    @stack('js')
</body>

</html>