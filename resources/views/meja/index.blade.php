<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Meja') }}
        </h2>
    </x-slot>

    <div>
        @if (session('sukses'))
            <div class="w-1/2 bg-green-500 flex flex-col items-center font-bold text-gray-200 rounded-md my-3 py-3 mx-auto">
                {{ session('sukses') }}
            </div>
        @elseif(session('errors'))
            <div class="w-1/2 bg-red-500 flex flex-col items-center font-bold text-gray-200 rounded-md my-3 py-3 mx-auto">
                {{ session('errors') }}
            </div>
        @endif

        <div class="max-w-7xl bg-slate-100 mx-auto py-5">
            <div class="sm:mx-6 lg:mx-8 sm:px-6 lg:px-8 bg-red-300 rounded-md pb-8">
                
                <x-button type="submit" class="items-center py-3 px-4 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-green-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 my-5"
                label="Tambah Meja" onclick="toggleModal('tambah_meja')" icon="fa-solid fa-plus"/>
            
                <div class="rounded-lg">
                    <table class="w-full whitespace-nowrap" id="table_meja">
                        <thead>
                            <tr class="text-center font-bold bg-slate-500 text-slate-200">
                                <x-table-column>Nomor Meja</x-table-column>
                                <x-table-column>Status</x-table-column>
                                <x-table-column>Aksi</x-table-column>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meja as $meja)
                            <tr class="hover:bg-slate-100 ">
                                <x-table-column>
                                    <div class="text-center bg-orange-400 rounded-md px-6 py-4 text-white m-2 w-fit mx-auto">
                                        {{ $meja->nomor_meja }}
                                    </div>
                                </x-table-column>
                                <x-table-column>
                                    @if ($meja->status == "ready")
                                        <div class=" flex justify-center text-center items-center p-4 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase mx-48">
                                            {{ $meja->status }}
                                        </div>
                                    @else
                                        <div class=" flex justify-center text-center items-center p-4 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase mx-48">
                                            {{ $meja->status }}
                                        </div>
                                    @endif
                                </x-table-column>
                                <x-table-column>
                                    <div class="flex justify-evenly">
                                        <x-button type="submit" class="items-center py-3 px-4 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                label="Edit" onclick="toggleModal('edit_meja{{ $loop->iteration }}')" icon="fa-solid fa-pencil"/>
                                    
                                        {{-- <x-button type="submit" class="items-center py-3 px-4 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                label="" onclick="toggleModal('')" icon="fa-solid fa-eye"/> --}}

                                        {{-- <x-button type="submit" class="items-center py-3 px-4 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                label="Hapus" onclick="toggleModal('hapus_meja{{ $loop->iteration }}')" icon="fa-solid fa-trash"/> --}}
                                            
                                    </div>
                                    
        
                                    {{-- Edit Meja --}}
                                    <x-modal_edit id="edit_meja{{ $loop->iteration }}" title="Edit Meja Nomor {{ $meja->nomor_meja }}" form="true">
                                        <form action="{{ route('meja.update',$meja->nomor_meja) }}" method="POST" class="">
                                            @csrf
                                            @method('PUT')

                                            <!-- status -->
                                            <div class="mt-4">
                                                <x-input-label for="status" :value="__('Status')" />

                                                <select name="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                                    <option value="{{ $meja->status }}">{{ $meja->status }}</option>
                                                    <option value="ready">Ready</option>
                                                    <option value="used">Used</option>
                                                </select>
                                                @if ($errors->get('status'))
                                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                    
                                                @endif
                                            </div>

                                            
                                    </x-modal_edit>

                                    {{-- Delete meja --}}
                                    {{-- <x-modal_delete id="hapus_meja{{ $loop->iteration }}" title="Hapus Meja" form="true">
                                        <form action="{{ route('meja.delete',$meja->id) }}" method="POST" class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            Apakah anda yakin akan menghapus meja nomor <span class="font-bold ">&nbsp;{{ $meja->nomor_meja }}&nbsp;</span> ?
                                        
                                    </x-modal_delete> --}}
                                </x-table-column>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                

                

                    {{-- Create Meja --}}
                    <x-modal_create id="tambah_meja" title="Tambah meja" form="true" >
                        <form action="{{ route('meja.store') }}" method="POST" class="">
                            @csrf

                            <!-- Nomor Meja -->
                            <div class="mt-4">
                                <x-input-label for="nomor_meja" :value="__('Nomor Meja')" />

                                <x-text-input id="nomor_meja" class="block mt-1 w-full" type="number" name="nomor_meja" :value="old('nomor_meja')" required autofocus />
                                
                                <x-input-error :messages="$errors->get('nomor_meja')" class="mt-2" />
                            </div>

                            <!--Status-->
                            <div class="mt-4">
                                <x-input-label for="status" :value="__('Status')" />

                                <select name="status" class="block mt-1 rounded-md">
                                    <option value="ready">Ready</option>
                                    <option value="used">Used</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>


                    </x-modal_create>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function toggleModal(modalID){
            document.getElementById(modalID).classList.toggle("invisible");
            document.getElementById(modalID + "_backdrop").classList.toggle("invisible");
            document.getElementById(modalID).classList.toggle("flex");
            document.getElementById(modalID + "_backdrop").classList.toggle("flex");
        }
    </script>
    
</x-app-layout>