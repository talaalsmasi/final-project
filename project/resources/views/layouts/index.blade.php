<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUa1z4gP8kK6sEU5B4GVNh2yZwl5KNkF2U5hgJMl5VjVRGNDKejknvWDXtZs" crossorigin="anonymous">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM0sP3tnE7GkKk0h4/4e2ZlEwtJtTjAl1bl1BKe" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <title>@yield('title')</title>

        <link href="{{ asset('style.css') }}" rel="stylesheet">
<!-- Color CSS -->

<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUa1z4gP8kK6sEU5B4GVNh2yZwl5KNkF2U5hgJMl5VjVRGNDKejknvWDXtZs" crossorigin="anonymous">


<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <!-- Slick Slider CSS -->
        <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet"/>
        <!-- Datepicker CSS -->
        <link href="{{ asset('css/dcalendar.picker.css') }}" rel="stylesheet"/>
        <!-- Animate CSS -->
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet"/>
        <!-- Animation CSS -->
        <link href="{{ asset('css/animation.css') }}" rel="stylesheet"/>
        <!-- Demo CSS -->
        <link href="{{ asset('css/demo.css') }}" rel="stylesheet"/>
        <!-- ICONS CSS -->
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
        <!-- jQuery bxSlider CSS -->
        <link href="{{ asset('css/jquery.bxslider.css') }}" rel="stylesheet">
        <!-- Pretty Photo CSS -->
        <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
        <!-- Custom Main StyleSheet CSS -->
        <link href="{{ asset('css/component.css') }}" rel="stylesheet">
        <!-- Typography CSS -->
        <link href="{{ asset('css/typography.css') }}" rel="stylesheet">
        <!-- Style Icon CSS -->
        <link href="{{ asset('css/style-icon.css') }}" rel="stylesheet"/>
        <!-- Custom Main StyleSheet CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Color CSS -->
        <link href="{{ asset('css/color.css') }}" rel="stylesheet">
        <!-- Responsive CSS -->
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
        <!-- login CSS -->
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">
        <style>
            span{
                color: black
            }
            .custom-shape-divider-bottom-1687358784 .shape-fill {
            fill:rgb(49, 47, 47);
        }
        .custom-shape-divider-top-1687264903 .shape-fill {
            fill: #090909;
        }
        .body{
            color: black
        }
        </style>



    </head>
    <body class="">
        @include('layouts.header')


        @yield('content')

        @include('layouts.footer')


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoHgtSgvN5zCg91g4Ghb5/zl5I7Vmt2xzzVmx2E7CFZ1pOQ" crossorigin="anonymous"></script>


    </body>

</html>

