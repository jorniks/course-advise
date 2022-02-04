<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Course Adviser App') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/font-awesome.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script><script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
  </head>

  <body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100 relative">
      <a href="/" class="z-20 bg-blue-800 text-white font-semibold fixed top-0 left-0 py-4 pl-3 pr-8 rounded-br-full">
        <i class="fas fa-home"></i> Home
      </a>
      
      <img src="{{url('fptb-logo.png')}}" alt="Poly Logo" class="h-16 absolute right-0 rounded-bl-3xl z-10" data-aos="fade-up-right"/>
        <!-- Page Content -->
        <main>
          {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    
    <script>
      window.addEventListener('alert', event => { 
        toastr[event.detail.type]( event.detail.message, event.detail.title ?? ''),
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "4000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
      });
    </script>

  </body>
</html>

@if(session()->has('toastSuccess'))
  <script>
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.success("{!! session()->get('toastSuccess') !!}")
  </script>
@endif

@if(session()->has('toastInfo'))
  <script>
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.info("{!! session()->get('toastInfo') !!}")
  </script>
@endif

@if(session()->has('toastWarning'))
  <script>
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.warning("{!! session()->get('toastWarning') !!}")
  </script>
@endif

@if(session()->has('toastError'))
  <script>
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.error("{!! session()->get('toastError') !!}")
  </script>
@endif