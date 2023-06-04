<?php
?>

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Vendor CSS Files -->
    <link href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}">
    <link href="{{ asset("assets/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/boxicons/css/boxicons.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/quill/quill.snow.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/quill/quill.bubble.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/remixicon/remixicon.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/simple-datatables/style.css") }}" rel="stylesheet">

    <link href=" {{ asset("assets/css/niceAdmin.css") }}" rel="stylesheet">
    <link href=" {{ asset("assets/css/global.css") }}" rel="stylesheet">



</head>
<body>

<style>
    /*--------------------------------------------------------------
# Main
--------------------------------------------------------------*/
    main {
        margin-top: 60px;
        padding: 20px 30px;
        transition: all 0.3s;
    }

    @media (max-width: 1199px) {
        #main {
            padding: 20px;
        }
    }


</style>
    @yield('content')

<script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("assets/vendor/apexcharts/apexcharts.min.js") }}"></script>
<script src="{{ asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/vendor/chart.js/chart.umd.js") }}"></script>
<script src="{{ asset("assets/vendor/echarts/echarts.min.js") }}"></script>
<script src="{{ asset("assets/vendor/quill/quill.min.js") }}"></script>
<script src="{{ asset("assets/vendor/simple-datatables/simple-datatables.js") }}"></script>
<script src="{{ asset("assets/vendor/tinymce/tinymce.min.js") }}"></script>
<script src="{{ asset("assets/vendor/php-email-form/validate.js") }}"></script>

<script src="{{ asset("assets/js/niceAdmin.js") }}"></script>



</body>
</html>
