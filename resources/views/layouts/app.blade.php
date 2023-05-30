<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <link href="{{ asset('css/milligram.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" defer>
    <link href="{{ asset('css/article.css') }}" rel="stylesheet">
    <link href="{{ asset('css/publisher.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script src="https://kit.fontawesome.com/c4a77b9891.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer>
    
</script>
  </head>
  <body>
    <div id = "flex-container">
     @include('layouts.aside')
      <div id="body-container">
          @include('layouts.header')
            <div id="content-container">
                @yield('content')
            </div>
          @include('layouts.footer')
      </div>
    </div> 
  </body>
</html>