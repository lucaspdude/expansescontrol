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
    <body class="bg-white text-gray-900 worksans leading-normal text-base tracking-normal">


        <div class="h-screen flex">
            <div class="bg-red-600 w-64">
                @include('layouts.navbar')
            </div>
            <div class="flex-1 flex overflow-hidden">
                <div class="flex-1 overflow-y-scroll bg-white py-8">
                    <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
