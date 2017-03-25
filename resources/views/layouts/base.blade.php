<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>zipCodesProject - @yield('tittle')</title>
    <!-- Fonts -->
    @section('fonts')
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    @endsection

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">
    @section('styles')
        <style>
            #loading {
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                position: fixed;
                display: block;
                opacity: 0.7;
                background-color: #fff;
                z-index: 99;
                text-align: center;
            }

            #loading-image {
                position: absolute;
                top: 100px;
                left: 240px;
                z-index: 100;
            }
        </style>
    @endsection

    <!-- Scripts -->
    <script type="text/javascript" src="/js/app.js"></script>
    @section('scripts')
    @endsection

</head>
<body style="background-color: dimgray; max-height: 700px; overflow-y: auto">
    @component('layouts.header')
    @endcomponent
    <div class="container" style=" margin: 0px 1%; background-color: whitesmoke;">
        @yield('content')
    </div>
    @component('layouts.footer')
    @endcomponent
</body>
<script>
    $(document).ready(function () {
        var $height = $(".container").height();

        if(innerHeight*0.9>$height){
            $("body").css({height: innerHeight,width: innerWidth});
            $("div.container").css({height: innerHeight-innerHeight*.09,width: innerWidth - innerWidth*0.02 });
        }
        @if( Request::getRequestUri() ==='/loading/zipCodes')
            $.getScript("/js/loading_zip_codes.js").done(function () {
            loadZipCodes();
        });
        @endif
        @if( Request::getRequestUri() ==='/loading/contacts')
            $.getScript("/js/loading_contacts.js").done(function () {
            loadContacts();
        });
        @endif
        @if( explode('/',Request::getRequestUri())[0]=='loading' and explode('/',Request::getRequestUri())[1] == 'fail' )
            $.getScript("/js/loading_after_fail.js").done(function () {
            reload();
        });
        @endif
    });

</script>
</html>
