<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--   Core   -->
<script src="{{ asset('js/plugins/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!--   Optional JS   -->
<script src="{{ asset('js/plugins/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
<!--   Argon JS   -->
@stack('scripts')
<script src="{{ asset('js/argon-dashboard.min.js?v=1.1.2') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


{{-- <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script> --}}


<script>
    window.TrackJS &&
        TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "argon-dashboard-free"
        });
</script>




