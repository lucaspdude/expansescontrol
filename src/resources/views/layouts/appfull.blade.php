<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KetchApp API - Tests</title>

        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <script src="{{ asset('js/app.js') }}"></script>

    </head>
    <body class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="bg-red-600 shadow-lg p-5" >
                <img class="mx-auto h-12 w-auto" src="{{ asset('images/logo/logo_ketchapp_branca.png') }}" alt="Workflow" />
                @yield('content')
            </div>
        </div>
    </body>
</html>
