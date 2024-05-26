<!DOCTYPE html>
<!--
  HOW TO USE:
  data-layout: fluid (default), boxed
  data-sidebar-theme: dark (default), colored, light
  data-sidebar-position: left (default), right
  data-sidebar-behavior: sticky (default), fixed, compact
-->
<html lang="en" data-bs-theme="dark" data-layout="fluid" data-sidebar-theme="dark" data-sidebar-position="left"
      data-sidebar-behavior="sticky">


<!-- Mirrored from appstack.bootlab.io/dashboard-default?theme=light by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 May 2024 14:53:55 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>Admin Panel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <!-- BEGIN SETTINGS -->
    <!-- Remove this after purchasing -->
    <script src="{{asset('js/settings.js')}}"></script>
    <!-- END SETTINGS -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q3ZYEKLQ68"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-Q3ZYEKLQ68');
    </script>
</head>

<body>
<div class="wrapper">
    @include('admin.layout-admin.side-navbar')
    <div class="main">
        @include('admin.layout-admin.top-navbar')
        @yield('content')
        @include('admin.layout-admin.footer')
    </div>
</div>
</body>

<script src="{{asset('js/app.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.cssVariables.primary,
                    borderColor: window.cssVariables.primary,
                    hoverBackgroundColor: window.cssVariables.primary,
                    hoverBorderColor: window.cssVariables.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .325,
                    categoryPercentage: .5
                }, {
                    label: "This year",
                    backgroundColor: window.cssVariables.primarySubtle,
                    borderColor: window.cssVariables.primarySubtle,
                    hoverBackgroundColor: window.cssVariables.primarySubtle,
                    hoverBorderColor: window.cssVariables.primarySubtle,
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                    barPercentage: .325,
                    categoryPercentage: .5
                }]
            },
            options: {
                maintainAspectRatio: false,
                cornerRadius: 15,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            stepSize: 20
                        },
                        stacked: true,
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "transparent"
                        },
                        stacked: true,
                    }]
                }
            }
        });
    });
</script>
<script>
    // Workaround for theme switch re-initialization issue
    var isTempusDominusInitialized = false;
    document.addEventListener("DOMContentLoaded", function () {
        if (isTempusDominusInitialized) {
            return;
        }
        isTempusDominusInitialized = true;
        new tempusDominus.TempusDominus(document.getElementById('calendar-dashboard'), {
            display: {
                inline: true,
                components: {
                    clock: false,
                    hours: false,
                    minutes: false
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: ["Direct", "Affiliate", "E-mail", "Other"],
                datasets: [{
                    data: [2602, 1253, 541, 1465],
                    backgroundColor: [
                        window.cssVariables.primary,
                        window.cssVariables.warning,
                        window.cssVariables.danger,
                        "#E8EAED"
                    ],
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                cutoutPercentage: 70,
                legend: {
                    display: false
                },
                elements: {
                    arc: {
                        borderWidth: 5,
                        borderColor: window.cssVariables.secondaryBg
                    }
                },
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $("#datatables-dashboard-projects").DataTable({
            destroy: true,
            pageLength: 6,
            lengthChange: false,
            bFilter: false,
            autoWidth: false
        });
    });
</script>


<!-- Mirrored from appstack.bootlab.io/dashboard-default?theme=light by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 May 2024 14:53:55 GMT -->
</html>
