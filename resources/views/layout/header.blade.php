<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from colorlib.com/preview/theme/essence/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Nov 2018 05:48:22 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>{{$data['data']['menu_name'] ?? 'Home' }} | Essence -Fashion Ecommerce</title>

    <!-- Favicon  -->
    <link rel="icon" href="/EssencesSite/img/core-img/favicon.ico">
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{asset('EssencesSite/css/all.css')}}">
    <style>@import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Ubuntu:300,400,500,700");</style>
    <script src="{{asset('EssencesSite/js/all.js')}}"></script>
    {{-- Stripe --}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{asset('EssencesSite/js/custom.js')}}"></script>

</head>

<body>
   <script>       
        getCart();
   </script>