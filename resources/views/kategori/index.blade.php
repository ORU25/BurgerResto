<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori Menu') }}
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
                label="Tambah Kategori" onclick="toggleModal('tambah_kategori')" icon="fa-solid fa-plus"/>
            
                

                <x-table id="table_kategori">
                    <x-slot name="header">
                        <x-table-column>No</x-table-column>
                        <x-table-column>Nama Kategori</x-table-column>
                        <x-table-column>Aksi</x-table-column>
                    </x-slot>
                    @foreach ($kategori as $kategori)
                        <tr class="hover:bg-slate-100 ">
                            <x-table-column>
                                <div class="text-center">
                                    {{ $loop->iteration }}
                                </div>
                            </x-table-column>
                            <x-table-column>{{ $kategori->nama_kategori }}</x-table-column>
                            <x-table-column>
                                <div class="flex justify-evenly">
                                    <x-button type="submit" class="items-center py-3 px-4 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Edit" onclick="toggleModal('edit_kategori{{ $loop->iteration }}')" icon="fa-solid fa-pencil"/>
                                   
                                    {{-- <x-button type="submit" class="items-center py-3 px-4 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="" onclick="toggleModal('')" icon="fa-solid fa-eye"/> --}}

                                    <x-button type="submit" class="items-center py-3 px-4 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Hapus" onclick="toggleModal('hapus_kategori{{ $loop->iteration }}')" icon="fa-solid fa-trash"/>
                                        
                                </div>
                                
    
                                {{-- Edit Kategori --}}
                                <x-modal_edit id="edit_kategori{{ $loop->iteration }}" title="Edit {{ $kategori->nama_kategori }}" form="true">
                                    <form action="{{ route('kategori.update',$kategori->id) }}" method="POST" class="">
                                        @csrf
                                        @method('PUT')

                                        <!-- nama_kategori -->
                                        <div class="mt-4">
                                            <x-input-label for="nama_kategori" :value="__('Nama Kategori')" />

                                            <x-text-input id="nama_kategori" class="block mt-1 w-full" type="text" name="nama_kategori" :value="$kategori->nama_kategori" required autofocus />
                                            
                                            <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                                        </div>

                                        
                                </x-modal_edit>

                                {{-- Delete kategori --}}
                                <x-modal_delete id="hapus_kategori{{ $loop->iteration }}" title="Hapus Kategori" form="true">
                                    <form action="{{ route('kategori.delete',$kategori->id) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        Apakah anda yakin akan menghapus <span class="font-bold ">&nbsp;{{ $kategori->nama_kategori }}&nbsp;</span> ?
                                    
                                </x-modal_delete>
                            </x-table-column>
                        </tr>
                    @endforeach
                </x-table>

                    {{-- Create Kategori --}}
                    <x-modal_create id="tambah_kategori" title="Tambah Kategori" form="true" >
                        <form action="{{ route('kategori.store') }}" method="POST" class="">
                            @csrf

                            <!-- Nama Kategori -->
                            <div class="mt-4">
                                <x-input-label for="nama_kategori" :value="__('Nama Kategori Menu')" />

                                <x-text-input id="nama_kategori" class="block mt-1 w-full" type="text" name="nama_kategori" :value="old('nama_kategori')" required autofocus />
                                
                                <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
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