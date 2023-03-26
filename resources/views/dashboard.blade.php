<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 justify-items-center">
            <a href="{{ route('pesanan.order') }}" class="my-5 w-80 py-16 bg-red-300 border border-gray-200 rounded-lg shadow hover:bg-red-200 ">
                <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-pen-to-square flex justify-center mb-3"></h5>
                <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Order</h5>
            </a>
            @if (\Auth::user()->role == 'admin')
                <a href="{{ route('user.index') }}" class="my-5 w-80 py-16 bg-red-300 border border-gray-200 rounded-lg shadow hover:bg-red-200 ">
                    <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-users flex justify-center mb-3"></h5>
                    <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">User</h5>
                </a>
                <a href="{{ route('kategori.index') }}" class="my-5 w-80 py-16 bg-red-300 border border-gray-200 rounded-lg shadow hover:bg-red-200 ">
                    <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-tag flex justify-center mb-3"></h5>
                    <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Kategori</h5>
                </a>
                <a href="{{ route('menu.index') }}" class="my-5 w-80 py-16 bg-red-300 border border-gray-200 rounded-lg shadow hover:bg-red-200 ">
                    <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-burger flex justify-center mb-3"></h5>
                    <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Menu</h5>
                </a>
                <a href="{{ route('meja.index') }}" class="my-5 w-80 py-16 bg-red-300 border border-gray-200 rounded-lg shadow hover:bg-red-200 ">
                    <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-chair flex justify-center mb-3"></h5>
                    <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Meja</h5>
                </a>
                
            
            
            @endif
            @if (\Auth::user()->role == 'admin' || \Auth::user()->role == 'kasir')
                <a href="{{ route('pesanan.index') }}" class="my-5 w-80 py-16 bg-red-300 border border-gray-200 rounded-lg shadow hover:bg-red-200 ">
                    <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-receipt flex justify-center mb-3"></h5>
                    <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Pesanan</h5>
                </a>
                <a href="{{ route('pembayaran.index') }}" class="my-5 w-80 py-16 bg-red-300 border border-gray-200 rounded-lg shadow hover:bg-red-200 ">
                    <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-cash-register flex justify-center mb-3"></h5>
                    <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">pembayaran</h5>
                </a>
            @endif
            @if (\Auth::user()->role == 'pegawai')
                <a href="{{ route('meja.index') }}" class="my-5 w-80 py-16 bg-red-300 border border-gray-200 rounded-lg shadow hover:bg-red-200 ">
                    <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-chair flex justify-center mb-3"></h5>
                    <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Meja</h5>
                </a>
                <a href="{{ route('pesanan.index') }}" class="my-5 w-80 py-16 bg-red-300 border border-gray-200 rounded-lg shadow hover:bg-red-200 ">
                    <h5 class=" text-5xl font-bold tracking-tight text-gray-800  fa-solid fa-receipt flex justify-center mb-3"></h5>
                    <h5 class=" text-xl font-bold tracking-tight text-gray-800 text-center">Pesanan</h5>
                </a>
            
            @endif
        </div>
    </div>
</x-app-layout>
