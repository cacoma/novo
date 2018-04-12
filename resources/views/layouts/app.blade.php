<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cacoma</title>

    <!-- Styles original -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
  <body>
    @include ('layouts.navbar')
    @guest
    <br>
    @yield('content')
    @else
    <div id="content">
          <div id="app">
              <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
              @include ('layouts.sidebar')
                </div>
             <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                @yield('content')
              </div>
              </div>
            
          </div>
     </div>
@endguest
    <footer class="row">
      @include ('layouts.footer')
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
