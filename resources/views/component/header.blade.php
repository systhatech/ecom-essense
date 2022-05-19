<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title  -->
    <title>{{isset($data['data']) ? (isset($data['data']['menu_name']) ? $data['data']['menu_name'].' | ' : ''): '' }} Essence -Fashion Ecommerce</title>
    <!-- Favicon  -->
    <link rel="icon" href="/img/core-img/favicon.ico">
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{asset('EssencesSite/css/all.css')}}">
    <style>@import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Ubuntu:300,400,500,700");</style>
    <script src="{{asset('EssencesSite/js/all.js')}}"></script>
    <script src="{{asset('EssencesSite/js/custom.js')}}"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
</head>
<body>
   <script>       
        getCart();
        getWish();
   </script>