<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no"/>

        <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">

        <title>{{ config('app.name', 'Cards') }}</title>

        <link href='http://fonts.googleapis.com/css?family=Robotoapp:300,400,500' rel='stylesheet' type='text/css'>

        <!-- uikit -->
        <link rel="stylesheet" href="{{ asset('template/bower_components/uikit/css/uikit.almost-flat.min.css') }}"/>

        <!-- altair admin login page -->
        <link rel="stylesheet" href="{{ asset('template/assets/css/login_page.min.css') }}" />

    </head>
    <body class="login_page">

        <div class="login_page_wrapper">
            <div class="md-card" id="login_card">
                @yield('content')
            </div>
            <div class="uk-margin-top uk-text-center">
                @yield('link')
            </div>
        </div>

        <!-- common functions -->
        <script src="{{ asset('template/assets/js/common.min.js') }}"></script>
        <!-- altair core functions -->
        <script src="{{ asset('template/assets/js/altair_admin_common.min.js') }}"></script>

        <!-- altair login page functions -->
        <script src="{{ asset('template/assets/js/pages/login.min.js') }}"></script>

    </body>
</html>