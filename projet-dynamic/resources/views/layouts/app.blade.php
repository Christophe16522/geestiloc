<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GestiLoc') — GestiLoc</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/gestiloc.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <x-navbar />
    <x-toast />
    <main class="main-content">
        <div class="container py-4">
            @yield('content')
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.filters-bar form').forEach(function (form) {
            // Hide the manual submit button — submission is now automatic
            const submitBtn = form.querySelector('.filter-actions button[type="submit"]');
            if (submitBtn) submitBtn.style.display = 'none';

            // Selects → submit immediately on change
            form.querySelectorAll('select').forEach(function (select) {
                select.addEventListener('change', function () { form.submit(); });
            });

            // Text inputs → submit after 400 ms of inactivity
            let debounceTimer;
            form.querySelectorAll('input[type="text"], input[type="search"]').forEach(function (input) {
                input.addEventListener('input', function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () { form.submit(); }, 400);
                });
            });
        });
    });
    </script>
    @stack('scripts')
</body>
</html>
