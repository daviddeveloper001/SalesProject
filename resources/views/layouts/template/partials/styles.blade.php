<!-- Favicon -->
<link href="{{ asset('img/brand/favicon.png') }}" rel="icon" type="image/png">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<!-- Icons -->
<link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
<link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
<!-- CSS Files -->
<link href="{{ asset('css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />

@vite(['resources/sass/app.scss', 'resources/js/app.js'])

@stack('styles')
