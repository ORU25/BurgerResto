<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('image/logo_BR.png') }}" type="image/x-icon"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .background{
                background-attachment: fixed;
                background-size: cover;
                background-image: url({{ asset('image/WallpaperUi.jpg') }});
            }
        </style>
    </head>
    <body class="">   
        <section class="background bg-center bg-no-repeat min-h-screen" >
            {{-- <img src="{{ asset('image/WallpaperUi.jpg') }}" class="w-full h-screen"/> --}}
            <div class=" w-3/5  flex items-center min-h-screen px-40 ">
                <div>

                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-black  ">Welcome to</h1>
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-black  ">BurgerResto</h1><br/><br/>
                    <p class="mb-8 text-sm  font-normal text-black">Nikmati sensasi kenikmatan burger yang luar biasa di restoran cepat saji kami! Dengan berbagai macam pilihan burger yang lezat dan bergizi, kami siap memuaskan selera Anda dengan menu utama yang tak terlupakan.</p>
                    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-end sm:space-y-0 sm:space-x-4">
                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="inline-flex justify-start items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-pink1 hover:bg-pink2 focus:ring-4 focus:ring-orange-300 " type="button">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
            
        </section>

        

        <!-- Mainmodal -->
        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-red-100 rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <div class=" bg-pink1 rounded-md  py-4 mt-2 w-fit mx-auto">
                            <h5 class="mx-10 text-xl font-bold tracking-tight text-white text-center">Pilih Makan Di Tempat atau Bawa Pulang ?</h5>
                        </div>
                        {{-- <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="defaultModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button> --}}
                    </div>
                    <!-- Modal body -->
                    <div class="flex justify-evenly">

                                <a href="{{ route('pesanan.dine_in') }}" class="mx-5 my-10 w-52 py-12 rounded-lg shadow bg-pink1 hover:bg-pink2 ">
                                    <h5 class=" text-5xl font-bold tracking-tight text-white  fa-solid fa-utensils flex justify-center mb-3"></h5>
                                    <h5 class=" text-xl font-bold tracking-tight text-white text-center">Makan Di Tempat</h5>
                                </a>
                                <a href="{{ route('pesanan.take_away') }}" class="mx-5 my-10 w-52 py-12 rounded-lg shadow bg-pink1 hover:bg-pink2 ">
                                    <h5 class=" text-5xl font-bold tracking-tight text-white  fa-solid fa-bag-shopping flex justify-center mb-3"></h5>
                                    <h5 class=" text-xl font-bold tracking-tight text-white text-center">Bawa Pulang</h5>
                                </a>
                        
                    </div>
                    
                </div>
            </div>
        </div>
  

        {{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-red-300">
            <div class=" mb-10 bg-orange-200 rounded-md  py-4 w-fit mx-auto shadow-lg  border-orange-300 border-8">
                <h5 class="mx-10 text-xl font-bold tracking-tight text-gray-800 text-center">Selamat Datang Di Burger Resto</h5>
            </div>
            <div class=" bg-white shadow-md overflow-hidden sm:rounded-lg">
                
                <div class="mt-10 bg-orange-300 rounded-md  py-4 w-fit mx-auto">
                    <h5 class="mx-10 text-xl font-bold tracking-tight text-gray-800 text-center">Pilih Makan Di Tempat atau Bawa Pulang ?</h5>
                </div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex ">
                    <a href="{{ route('pesanan.dine_in') }}" class="mx-5 my-10 w-52 py-12 bg-white border-8 border-orange-300 rounded-lg shadow hover:bg-orange-300 ">
                        <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-utensils flex justify-center mb-3"></h5>
                        <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Makan Di Tempat</h5>
                    </a>
                    <a href="{{ route('pesanan.take_away') }}" class="mx-5 my-10 w-52 py-12 bg-white border-8 border-orange-300 rounded-lg shadow hover:bg-orange-300 ">
                        <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-bag-shopping flex justify-center mb-3"></h5>
                        <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Bawa Pulang</h5>
                    </a>
                </div>
            
            </div>
        </div> --}}
    </body>
</html>
    
