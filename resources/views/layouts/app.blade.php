<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="{{asset('template/assets/img/favicon-16x16.png')}}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{asset('template/assets/img/favicon-32x32.png')}}" sizes="32x32">

    <title>Cards</title>


    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('template/bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="{{ asset('template/assets/icons/flags/flags.min.css') }}" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/main.css') }}" media="all">
    @yield('css')
    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
        <script type="text/javascript" src="{{asset('template/bower_components/matchMedia/matchMedia.js')}}"></script>
        <script type="text/javascript" src="{{asset('template/bower_components/matchMedia/matchMedia.addListener.js')}}"></script>
    <![endif]-->

</head>
<body class=" sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    @include('layouts.header')
    <!-- main header end -->
   
    <!-- main sidebar -->
    @include('layouts.sidebar')
    <!-- main sidebar end -->

    <div id="page_content">
        @yield('content')
    </div>

    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="{{ asset('template/assets/js/common.js') }}"></script>
    <!-- uikit functions -->
    <script src="{{ asset('template/assets/js/uikit_custom.js') }}"></script>
    <!-- altair common functions/helpers -->
    <script src="{{ asset('template/assets/js/altair_admin_common.js') }}"></script>
    
    <!-- page specific plugins -->
    <!-- parsley (validation) -->
    <script>
    // load parsley config (altair_admin_common.js)
    altair_forms.parsley_validation_config();
    </script>
    <script src="{{ asset('template/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    
    <!-- page specific plugins -->
    @yield('js')
    
    
    <script>
//        $(function() {
//            // enable hires images
//            altair_helpers.retina_images();
//            // fastClick (touch devices)
//            if(Modernizr.touch) {
//                FastClick.attach(document.body);
//            }
//        });
    </script>

</body>
</html>