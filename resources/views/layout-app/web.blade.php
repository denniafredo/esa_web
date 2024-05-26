<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="PxEWRCbSiVH8HA8yEWpBDv2sOAUbkcLdxvCs0w6Z">
    <title>Cosmetic App</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
    <link rel='stylesheet' href="{{asset('css/common.css')}}"/>
    <link rel='stylesheet' href="{{asset('css/default.css')}}"/>
</head>
<script src="{{asset('js/backend-bundle.min.js')}}"></script>


@include('layout-app.top-navbar')
<div id="wrap_sub">
    <div class="sub_content">
        @include('layout-app.side-navbar')
        @yield('content')
    </div>
</div>

@include('layout-app.footer')
</body>

</html>
