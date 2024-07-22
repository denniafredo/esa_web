<!doctype html>
<html lang="en">


<!-- Mirrored from risingtheme.com/html/demo-becute/becute/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Jun 2024 11:55:24 GMT -->
<head>
    <meta charset="utf-8">
    <title>PT ESA SEMARAK ABADI</title>
    <meta property="og:image" content="{{asset('images/top_logo.png')}}"/>
    <meta name="description"
          content="PT ESA SEMARAK ABADI is a company that produces Skin Care products founded with the passion and dedication of talented young people and managed with Professionals. In the midst of ongoing developments and changes, we are here to innovate to bring fresh air to the beauty industry with innovative and quality products. Supported by experienced management, we are determined to present products that are in accordance with trends, new developments and according to the needs of the community.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/top_logo.png')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('images/top_logo.png')}}">

    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{asset('css/plugins/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/glightbox.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@300;400;500;700;900&amp;family=Karma:wght@300;400;500;600;700&amp;display=swap"
          rel="stylesheet">

    <!-- Plugin css -->
    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
<div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                    <span data-text-preloader="L" class="letters-loading">
                        L
                    </span>

                <span data-text-preloader="O" class="letters-loading">
                        O
                    </span>

                <span data-text-preloader="A" class="letters-loading">
                        A
                    </span>

                <span data-text-preloader="D" class="letters-loading">
                        D
                    </span>

                <span data-text-preloader="I" class="letters-loading">
                        I
                    </span>

                <span data-text-preloader="N" class="letters-loading">
                        N
                    </span>

                <span data-text-preloader="G" class="letters-loading">
                        G
                    </span>
            </div>
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
</div>

@include('layout-app.top-navbar')

@yield('content')

@include('layout-app.footer')

<script src="{{asset('js/vendor/popper.js')}}" defer="defer"></script>
<script src="{{asset('js/vendor/bootstrap.min.js')}}" defer="defer"></script>
<script src="{{asset('js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{asset('js/plugins/glightbox.min.js')}}"></script>

<!-- Customscript js -->
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/quill.js')}}"></script>

</body>

</html>
