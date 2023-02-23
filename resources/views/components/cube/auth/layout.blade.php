<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/cube.css')

    {{-- Additional Styles --}}
    @yield('styles')

    <title>{{ $title }}</title>
</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="wrapper">

        <div class="overlay"></div>

        <x-cube.auth.sidebar :user="$user"></x-cube.auth.sidebar>

        <div class="content">

            <x-cube.auth.topbar :user="$user" :title="$originTitle"></x-cube.auth.topbar>

            <main class="main">

                {{ $slot }}

            </main>

        </div>

    </div>

    @vite('resources/js/cube.js')

    {{-- Additional Scripts --}}
    @yield('scripts')

</body>

</html>
