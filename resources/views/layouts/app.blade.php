<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="PxEWRCbSiVH8HA8yEWpBDv2sOAUbkcLdxvCs0w6Z">
    <title>Human Resource</title>
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}"/>
    <link rel='stylesheet' href="{{asset('vendor/fullcalendar/core/main.css')}}"/>
    <link rel='stylesheet' href="{{asset('vendor/fullcalendar/daygrid/main.css')}}"/>
    <link rel='stylesheet' href="{{asset('vendor/fullcalendar/timegrid/main.css')}}"/>
    <link rel='stylesheet' href="{{asset('vendor/fullcalendar/list/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/backend-plugin.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/backende209.css?v=1.0.0')}}">
    <link rel="stylesheet" href="{{asset('css/backende209.css?v=1.0.0')}}">
    <link rel="stylesheet" href="{{asset('vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/flatpickr/flatpickr.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/remixicon/fonts/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/Leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/inputfile.css')}}">
</head>
<body class="" id="app">
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<script src="{{asset('js/backend-bundle.min.js')}}"></script>

<!-- Flextree Javascript-->
<script src="{{asset('js/flex-tree.min.js')}}"></script>
<script src="{{asset('js/tree.js')}}"></script>

<!-- Table Treeview JavaScript -->
<script src="{{asset('js/table-treeview.js')}}"></script>

<!-- SweetAlert JavaScript -->
<script src="{{asset('js/sweetalert.js')}}"></script>

<!-- Vectoe Map JavaScript -->
<script src="{{asset('js/vector-map-custom.js')}}"></script>

<!-- Chart Custom JavaScript -->
<script src="{{asset('js/customizer.js')}}"></script>

<script src="{{asset('vendor/Leaflet/leaflet.js')}}"></script>
<script src="{{asset('vendor/flatpickr/flatpickr.js')}}"></script>


<script src="{{asset('js/charts/progressbar.js')}}"></script>

<!-- Chart Custom JavaScript -->
<script src="{{asset('js/chart-custom.js')}}"></script>
<script src="{{asset('js/charts/01.js')}}"></script>
<script src="{{asset('js/charts/02.js')}}"></script>

<!-- slider JavaScript -->
<script src="{{asset('js/slider.js')}}"></script>

<!-- Emoji picker -->
{{--<script src="{{asset('vendor/emoji-picker-element/index.js')}}" type="module"></script>--}}
<!-- app JavaScript -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/inputfile.js')}}"></script>

@include('top-navbar')
@include('side-navbar')

<div class="container">
    @yield('content')
</div>

@include('footer')


<!-- Backend Bundle JavaScript -->

<script>
    (function ($) {
        "use strict";

        $(document).ready(function () {
            $('.select2js').select2();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.loadRemoteModel', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');

                if (url.indexOf('#') == 0) {
                    $(url).modal('open');
                } else {
                    $.get(url, function (data) {
                        $('#remoteModelData').html(data);
                        $('#remoteModelData').modal();
                        $('form').validator();
                        $(".datepicker").flatpickr({
                            dateFormat: "d-m-Y"
                        });
                    });
                }
            });

            $(document).on('click', '[data-form="ajax"]', function (f) {
                $('form').validator('update');
                f.preventDefault();
                var current = $(this);
                current.addClass('disabled');
                var form = $(this).closest('form');
                var url = form.attr('action');
                var fd = new FormData(form[0]);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: fd, // serializes the form's elements.
                    success: function (e) {
                        if (e.status == true) {
                            if (e.event == "submited") {
                                showMessage(e.message);
                                $(".modal").modal('hide');
                            }
                            if (e.event == 'refresh') {
                                // showMessage(e.message);
                                window.location.reload();
                            }
                            if (e.event == "callback") {
                                showMessage(e.message);
                                $(".modal").modal('hide');
                                location.reload();
                            }
                        }
                        if (e.status == false) {
                            if (e.event == 'validation') {
                                errorMessage(e.message);
                            }
                        }
                    },
                    error: function (error) {

                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                });
                f.preventDefault(); // avoid to execute the actual submit of the form.

            });

            $(document).ready(function () {

                $(document).on('change', '.change_status', function () {

                    var status = $(this).prop('checked') == true ? 1 : 0;
                    console.log(status)
                    var id = $(this).attr('data-id');
                    var type = $(this).attr('data-type');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "https://templates.iqonic.design/datum/laravel/public/changeStatus",
                        data: {'status': status, 'id': id, 'type': type},
                        success: function (data) {
                            alert(data.message);
                        }
                    });
                })
            })

            $(document).on('click', '[data-toggle="tabajax"]', function (e) {
                e.preventDefault();
                var selectDiv = this;
                ajaxMethodCall(selectDiv);
            });

            function ajaxMethodCall(selectDiv) {

                var $this = $(selectDiv),
                    loadurl = $this.attr('data-href'),
                    targ = $this.attr('data-target'),
                    id = selectDiv.id || '';

                $.post(loadurl, function (data) {
                    $(targ).html(data);
                    $('form').append('<input type="hidden" name="active_tab" value="' + id + '" />');
                });

                $this.tab('show');
                return false;
            }

            $('form[data-toggle="validator"]').on('submit', function (e) {
                window.setTimeout(function () {
                    var errors = $('.has-error')
                    if (errors.length) {
                        $('html, body').animate({scrollTop: "0"}, 500);
                        e.preventDefault()
                    }
                }, 0);
            });
        });
    })(jQuery);
</script>
</body>

</html>
