<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>
    @include('layouts.template.partials.styles')
</head>

<body class="">
    @include('layouts.template.partials.sidebar')
    <div class="main-content">

        <!-- Navbar -->
        @include('layouts.template.partials.navbar')
        <!-- End Navbar -->
        <!-- Header -->
        @include('layouts.template.partials.header')
        <div class="container-fluid mt--7">


            @yield('content')
            <!-- Footer -->
            @include('layouts.template.partials.footer')
        </div>
    </div>

    @include('layouts.template.partials.scripts')
</body>

</html>
