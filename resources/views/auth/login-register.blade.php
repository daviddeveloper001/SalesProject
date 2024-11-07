<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    @yield('title')
  </title>
  @include('layouts.theme.partials.styles')
</head>

<body class="bg-default">
  <div class="main-content">

    <!-- Header -->
    @include('auth.partials.login-register-header')
    <!-- Page content -->
        @yield('content')
    
    @include('auth.partials.login-register-footer')
  </div>
  @include('layouts.theme.partials.scripts')
</body>

</html>