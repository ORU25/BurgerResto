<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div>
        @if (session('sukse'))
            <div class="w-1/2 bg-green-500 flex flex-col items-center font-bold text-gray-200 rounded-md mb-5 py-3 mx-auto">
                {{ session('sukses') }}
            </div>
        @elseif(session('errors'))
            <div class="w-1/2 bg-red-500 flex flex-col items-center font-bold text-gray-200 rounded-md mb-5 py-3 mx-auto">
                {{ session('errors') }}
            </div>
        @endif

        <div class="max-w-7xl bg-slate-100 mx-auto py-12">
            <div class="sm:mx-6 lg:mx-8 sm:px-6 lg:px-8 bg-white rounded-md pb-8">
                
            </div>
        </div>
    </div>
</x-app-layout>
