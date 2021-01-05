<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Larave') }}</title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('css/components.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('css/layout/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/layout/default.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/layout/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    @yield('css')
</head>
<body>
    <div id="app">
        <body class="page-container-bg-solid page-boxed">
            @include('layouts.partials.header')
            
                @yield('content')
            
            @include('layouts.partials.footer')
        </body>
    </div>
    @include('layouts.partials.Scripts')
    @yield('script')
    <script>       
        window.BaseUrl = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        });
    </script>
</body>
</html>
