<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title or 'Up Delivery'}}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Fonts Icons -->
    <link rel="stylesheet" href="{{url('assets/css/font-awesome.css')}}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/reset.css')}}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{url('assets/imgs/favicon.png')}}">

</head>
<body>

    @include('store.layouts.header')

    <div class="container">
    @yield('content')
    </div>
    <!-- JavaScript JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- JavaScript Bootstrap-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    @stack('scripts')
</body>
</html>
