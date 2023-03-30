<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-red-300">
            <div class=" mb-10 bg-orange-200 rounded-md  py-4 w-fit mx-auto shadow-lg  border-orange-300 border-8">
                <h5 class="mx-10 text-xl font-bold tracking-tight text-gray-800 text-center">Selamat Datang Di Burger Resto</h5>
            </div>
            <div class=" bg-white shadow-md overflow-hidden sm:rounded-lg">
                
                <div class="mt-10 bg-orange-300 rounded-md  py-4 w-fit mx-auto">
                    <h5 class="mx-10 text-xl font-bold tracking-tight text-gray-800 text-center">Pilih Makan Di Tempat atau Bawa Pulang ?</h5>
                </div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex ">
                    <a href="{{ route('pesanan.dine_in') }}" class="mx-5 my-10 w-52 py-14 bg-orange-300 border border-gray-200 rounded-lg shadow hover:bg-orange-200 ">
                        <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-utensils flex justify-center mb-3"></h5>
                        <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Makan Di Tempat</h5>
                    </a>
                    <a href="{{ route('pesanan.take_away') }}" class="mx-5 my-10 w-52 py-14 bg-orange-300 border border-gray-200 rounded-lg shadow hover:bg-orange-200 ">
                        <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-bag-shopping flex justify-center mb-3"></h5>
                        <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Bawa Pulang</h5>
                    </a>
                </div>
            
            </div>
        </div>
    </body>
</html>
    