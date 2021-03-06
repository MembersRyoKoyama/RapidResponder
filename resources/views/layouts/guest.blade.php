<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <?php /*<title>{{ config('app.name', 'RapidResponder') }}</title>*/ ?>
    <title>A社のサイト</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sendAnswerForm.js') }}"></script>
    <script src="{{ asset('js/questionTag.js') }}"></script>
    <!-- remodal -->
    <script src="{{asset('js/remodal.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.js" integrity="sha512-a/KwXZUMuN0N2aqT/nuvYp6mg1zKg8OfvovbIlh4ByLw+BJ4sDrJwQM/iSOd567gx+yS0pQixA4EnxBlHgrL6A==" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/confirm.css') }}" rel="stylesheet">
    <link href="{{ asset('css/send.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal-default-theme.css" integrity="sha512-nF9G9AnUEVv+zx285OqwGE8c1gmkys3qV6iuDK5rVG/UuZLWRgGBy/tN5WzSXXuZDZ1YvwhJ9+a/DTj71L8Lrw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.css" integrity="sha512-LVOzFPLcBUppn3NOx8FXJkh2TawWu/jk9ynbntKID6cjynQsfqmHlUbH72mjAwZXsu0LOLw26JoiC0qHJde70Q==" crossorigin="anonymous" />
    <!-- remodal -->

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" 　href="{{ url('/question') }}">
                    A社のサイト
                </a>
                <?php /*<a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>*/ ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>

        @yield('footer')

    </div>
</body>

</html>