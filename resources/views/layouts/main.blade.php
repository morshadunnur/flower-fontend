<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    <link rel="icon" href="assets/images/favicon/10.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon/10.png" type="image/x-icon">
    <title>Multikart - Multi-purpopse E-commerce Html Template</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('multicart/css/fontawesome.css') }}">

    <!--Slick flower/insta css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('multicart/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('multicart/css/slick-theme.css') }}">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('multicart/css/animate.css') }}">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('multicart/css/themify-icons.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('multicart/css/bootstrap.css') }}">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('multicart/css/color10.css') }}" media="screen" id="color">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}">
    @stack('css')
    @stack('header-js')

</head>

<body>

<!-- loader start -->
@include('layouts.partials.loader')
<!-- loader end -->


<!-- header start -->
@include('layouts.partials.header')
<!-- header end -->


@yield('content')


<!-- footer start -->
@include('layouts.partials.footer')
<!-- footer end -->





<!-- tap to top start -->
<div class="tap-top">
    <div><i class="fa fa-angle-double-up"></i></div>
</div>
<!-- tap to top end -->


<!-- latest jquery-->
<script src="{{ asset('multicart/js/jquery-3.3.1.min.js') }}"></script>

<!-- menu js-->
<script src="{{ asset('multicart/js/menu.js') }}"></script>

<!-- lazyload js-->
<script src="{{ asset('multicart/js/lazysizes.min.js') }}"></script>

<!-- popper js-->
<script src="{{ asset('multicart/js/popper.min.js') }}"></script>

<!-- slick js-->
<script src="{{ asset('multicart/js/slick.js') }}"></script>

<!-- Bootstrap js-->
<script src="{{ asset('multicart/js/bootstrap.js') }}"></script>

<!-- Bootstrap Notification js-->
<script src="{{ asset('multicart/js/bootstrap-notify.min.js') }}"></script>

<!-- Theme js-->
<script src="{{ asset('multicart/js/script.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/vue.js') }}"></script>

<script>
    $(window).on('load', function () {
        setTimeout(function () {
            $('#exampleModal').modal('show');
        }, 2500);
    });

    function openSearch() {
        document.getElementById("search-overlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("search-overlay").style.display = "none";
    }
</script>
@stack('footer-js')
</body>
</html>
