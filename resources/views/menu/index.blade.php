<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menu') }}
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
                label="Tambah Menu" onclick="toggleModal('tambah_menu')" icon="fa-solid fa-plus"/>
            
                

                <x-table id="table_menu">
                    <x-slot name="header">
                        <x-table-column>No</x-table-column>
                        <x-table-column>Gambar</x-table-column>
                        <x-table-column>Nama</x-table-column>
                        <x-table-column>Kategori</x-table-column>
                        <x-table-column>Stok</x-table-column>
                        <x-table-column>Harga</x-table-column>
                        <x-table-column>Status</x-table-column>
                        <x-table-column>Aksi</x-table-column>
                    </x-slot>
                    @foreach ($menu as $menu)
                        <tr class="hover:bg-slate-100 ">
                            <x-table-column>
                                <div class="text-center">
                                    {{ $loop->iteration }}
                                </div>
                            </x-table-column>
                            <x-table-column>
                                <img src="{{ asset('foto_menu/'.$menu->gambar) }}" width="60" height="60" alt="{{ $menu->nama }}">
                            </x-table-column>
                            <x-table-column>{{ $menu->nama }}</x-table-column>
                            <x-table-column>{{ $menu->kategori->nama_kategori}}</x-table-column>
                            <x-table-column>{{ $menu->stok }}</x-table-column>
                            <x-table-column>Rp{{ number_format($menu->harga, 2,",",".") }}</x-table-column>
                            <x-table-column>{{ $menu->status }}</x-table-column>
                            <x-table-column>
                                <div class="flex justify-evenly">
                                    <x-button type="submit" class="items-center py-3 px-4 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Edit" onclick="toggleModal('edit_menu{{ $loop->iteration }}')" icon="fa-solid fa-pencil"/>
                                   
                                    {{-- <x-button type="submit" class="items-center py-3 px-4 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="" onclick="toggleModal('')" icon="fa-solid fa-eye"/> --}}

                                    <x-button type="submit" class="items-center py-3 px-4 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Hapus" onclick="toggleModal('hapus_menu{{ $loop->iteration }}')" icon="fa-solid fa-trash"/>
                                        
                                </div>
                                
    
                                {{-- Edit menu --}}
                                <x-modal_edit id="edit_menu{{ $loop->iteration }}" title="Edit {{ $menu->nama }}" form="true">
                                    <form action="{{ route('menu.update',$menu->id) }}" method="POST" class="" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- nama -->
                                        <div class="mt-4">
                                            <x-input-label for="nama" :value="__('Nama menu')" />

                                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="$menu->nama" required autofocus />
                                            @if ($errors->get('nama'))    
                                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                            @endif
                                        </div>
                                        <!-- gambar -->
                                        <div class="mt-4">
                                            <x-input-label for="gambar" :value="__('gambar menu')" />

                                            <x-text-input id="gambar" class="block mt-1 w-full" type="file" name="gambar"   />
                                            @if ($errors->get('gambar'))    
                                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                                            @endif
                                        </div>
                                        <!-- kategori -->
                                        <div class="mt-4">
                                            <x-input-label for="kategori" :value="__('Kategori ')" />
                                            
                                            <select class=" block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'" name="kategori">
                                                    <option value="{{ $menu->kategori_id }}">{{ $menu->kategori->nama_kategori }}</option>
                                                @foreach($kategori as $kategori2)
                                                    <option value="{{ $kategori2->id }}">{{$kategori2->nama_kategori}}</option>
                                                @endforeach
                                                
                                            </select>
                                            @if ($errors->get('kategori'))    
                                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                                            @endif
                                        </div>
                                        <!-- stok -->
                                        <div class="mt-4">
                                            <x-input-label for="stok" :value="__('Stok')" />

                                            <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="$menu->stok" required autofocus />
                                            @if ($errors->get('stok'))
                                            <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                                            @endif
                                        </div>
                                        <!-- harga -->
                                        <div class="mt-4">
                                            <x-input-label for="harga" :value="__('harga menu')" />

                                            <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="$menu->harga" required autofocus />
                                            @if ($errors->get('harga'))
                                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                                            @endif
                                        </div>
                                        <!-- status -->
                                        <div class="mt-4">
                                            <x-input-label for="status" :value="__('Status')" />

                                            <select name="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                                <option value="{{ $menu->status }}">{{ $menu->status }}</option>
                                                <option value="ready">Ready</option>
                                                <option value="sold">Sold</option>
                                            </select>
                                            @if ($errors->get('status'))
                                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                
                                            @endif
                                        </div>

                                        
                                </x-modal_edit>

                                {{-- Delete menu --}}
                                <x-modal_delete id="hapus_menu{{ $loop->iteration }}" title="Hapus menu" form="true">
                                    <form action="{{ route('menu.delete',$menu->id) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        Apakah anda yakin akan menghapus <span class="font-bold ">&nbsp;{{ $menu->nama }}&nbsp;</span> ?
                                    
                                </x-modal_delete>
                            </x-table-column>
                        </tr>
                    @endforeach
                </x-table>

                    {{-- Create menu --}}
                    <x-modal_create id="tambah_menu" title="Tambah menu" form="true" >
                        <form action="{{ route('menu.store') }}" method="POST" class="" enctype="multipart/form-data">
                            @csrf

                            <!-- Nama -->
                            <div class="mt-4">
                                <x-input-label for="nama" :value="__('Nama Menu')" />

                                <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
                                @if($errors->get('nama'))
                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                @endif
                            </div>
                            <!-- Gambar -->
                            <div class="mt-4">
                                <x-input-label for="gambar" :value="__('Gambar Menu')" />

                                <x-text-input id="gambar" class="block mt-1 w-full" type="file" name="gambar" :value="old('gambar')" required autofocus />
                                @if ($errors->get('gambar'))
                                    <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                                @endif
                            </div>
                            <!-- Kategori -->
                            <div class="mt-4">
                                <x-input-label for="kategori" :value="__('Kategori Menu')" />

                                <select class=" block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'" name="kategori">
                                    @foreach($kategori as $kategori)
                                        <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->get('kategori'))
                                    <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
                                @endif
                            </div>
                            <!-- Stok -->
                            <div class="mt-4">
                                <x-input-label for="stok" :value="__('Stok Menu')" />

                                <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="old('stok')" required autofocus />
                                @if ($errors->get('stok'))
                                <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                                @endif
                            </div>
                            <!-- Harga -->
                            <div class="mt-4">
                                <x-input-label for="harga" :value="__('Harga Menu')" />

                                <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga')" required autofocus />
                                @if ($errors->get('harga'))
                                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                                @endif
                            </div>
                            <!-- Status -->
                            <div class="mt-4">
                                <x-input-label for="status" :value="__('Status')" />

                                <select name="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                    <option value="ready">Ready</option>
                                    <option value="sold">Sold</option>
                                </select>
                                @if ($errors->get('status'))
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                @endif
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