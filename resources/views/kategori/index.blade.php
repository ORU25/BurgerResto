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
                
                <button data-modal-target="tambah_kategori" data-modal-toggle="tambah_kategori" class="capitalize  items-center py-2 px-2 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-green-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 my-5" type="button" >
                    <i class="fa-solid fa-plus"></i>
                    Tambah Kategori
                </button>                

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
                                <div class="flex justify-center">
                                    <button data-modal-target="edit_kategori{{ $loop->iteration }}" data-modal-toggle="edit_kategori{{ $loop->iteration }}" class="mx-2 fa-solid fa-pencil items-center py-2 px-3 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="button">
                                    </button>
                                    <button data-modal-target="delete_kategori{{ $loop->iteration }}" data-modal-toggle="delete_kategori{{ $loop->iteration }}" class="mx-2 fa-solid fa-trash items-center py-2 px-3 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="button">
                                    </button> 

                                    
                                </div>
                                
    
                                {{-- Edit Kategori --}}
                                <div id="edit_kategori{{ $loop->iteration }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Edit Ketegori {{ $kategori->nama_kategori }}
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit_kategori{{ $loop->iteration }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 space-y-6">
                                                <form action="{{ route('kategori.update',$kategori->id) }}" method="POST" class="">
                                                    @csrf
                                                    @method('PUT')
            
                                                    <!-- nama_kategori -->
                                                    <div class="mt-4">
                                                        <x-input-label for="nama_kategori" :value="__('Nama Kategori')" />
            
                                                        <x-text-input id="nama_kategori" class="block mt-1 w-full" type="text" name="nama_kategori" :value="$kategori->nama_kategori" required autofocus />
                                                        
                                                        <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="flex items-center pt-6 mt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button data-modal-hide="" type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</button>
                                                        <button data-modal-hide="edit_kategori{{ $loop->iteration }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>


                                {{-- Delete kategori --}}
                                <div id="delete_kategori{{ $loop->iteration }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="delete_kategori{{ $loop->iteration }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <form action="{{ route('kategori.delete',$kategori->id) }}" method="POST" class="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin akan menghapus <span class="font-bold ">&nbsp;{{ $kategori->nama_kategori }}&nbsp;</span> ?</h3>
                                                    <button data-modal-hide="delete_kategori{{ $loop->iteration }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                        Yes, Hapus
                                                    </button>
                                                    <button data-modal-hide="delete_kategori{{ $loop->iteration }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, Batal</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-table-column>
                        </tr>
                    @endforeach
                </x-table>

                    {{-- Create Kategori --}}
                    <div id="tambah_kategori" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Tambah Kategori Baru
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="tambah_kategori">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <form action="{{ route('kategori.store') }}" method="POST" class="">
                                        @csrf
            
                                        <!-- Nama Kategori -->
                                        <div class="mt-4">
                                            <x-input-label for="nama_kategori" :value="__('Nama Kategori Menu')" />
            
                                            <x-text-input id="nama_kategori" class="block mt-1 w-full" type="text" name="nama_kategori" :value="old('nama_kategori')" required autofocus />
                                            
                                            <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center pt-6 mt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button data-modal-hide="" type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</button>
                                            <button data-modal-hide="tambah_kategori" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            
                            </div>
                        </div>
                    </div>
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