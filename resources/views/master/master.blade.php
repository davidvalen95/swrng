<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{isset($title) ? "$title - Sewa Ruang" : "Sewa Ruang"}} </title>
    <link rel="icon" type="image/png" href="{{publicAsset('image/framework/favicon.png')}}">
    <meta name="description" content="{{isset($description) ? $description : "description"}}">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="{{publicAsset('css/framework/bootstrap.min.css')}}">
    <link rel="stylesheet" href='{{publicAsset("css/framework/bootstrap-responsive.min.css")}}'>
    <link rel="stylesheet" href="{{publicAsset("css/framework/vendor/bootstrap-select.css")}}">
    <link rel="stylesheet" href="{{publicAsset("css/framework/vendor/slider.css")}}">
    <link rel="stylesheet" href="{{publicAsset("css/framework/jquery.mCustomScrollbar.css")}}">
    <link rel="stylesheet" href="{{publicAsset("css/framework/style.css")}}">
    <link rel="stylesheet" href="{{publicAsset("plugins/easy-autocomplete/easy-autocomplete.min.css")}}">
    <link rel="stylesheet" href="{{publicAsset("plugins/magnific-popup/magnific-popup.css")}}">

    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <script
            src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>


    <style>
        .label-required:after, .label-required::after{
            content: ' *';
            color:tomato;
        }
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        input{
            min-height: 40px!important;
        }
        label{
            color: #222 !important;
        }
        label.checkbox{
            display: inline-block;
        }

        .radio input[type="radio"], .checkbox input[type="checkbox"] {
             float: none !important;
             margin-left: 0 !important;;
        }
    </style>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a
        href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<span id="data-global" data-url="{{route('get.index')}}"></span>
@include('master.navbar')

@yield('content')

@include('master.footer')

<script src="{{publicAsset("js/framework/vendor/jquery-1.9.1.min.js")}}"></script>
<script src="{{publicAsset("js/framework/vendor/bootstrap.js")}}"></script>
<script src="{{publicAsset("js/framework/vendor/bootstrap-select.min.js")}}"></script>
<script src="{{publicAsset("js/framework/vendor/jquery.flexslider-min.js")}}"></script>
<script src="{{publicAsset("js/framework/vendor/bootstrap-slider.js")}}"></script>
<script src="{{publicAsset("js/framework/vendor/jquery.mCustomScrollbar.min.js")}}"></script>
<script src="{{publicAsset("js/framework/vendor/tinynav.min.js")}}"></script>
<script src="{{publicAsset("js/framework/vendor/jquery.placeholder.min.js")}}"></script>
<script src="{{publicAsset("js/framework/vendor/gmap3.min.js")}}"></script>
<script src="{{publicAsset("plugins/easy-autocomplete/jquery.easy-autocomplete.min.js")}}"></script>
<script src="{{publicAsset("plugins/magnific-popup/jquery.magnific-popup.min.js")}}"></script>
<script src="{{publicAsset("js/framework/main.js")}}"></script>
<script src="{{publicAsset("js/main.js")}}"></script>
@yield('js')
</body>
</html>
