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
                @foreach ($errors->all() as $error)
                   {{ $error }}
                @endforeach
            </div>
        @endif

        <div class="max-w-7xl bg-slate-100 mx-auto py-5">
            <div class="sm:mx-6 lg:mx-8 sm:px-6 lg:px-8 bg-red-300 rounded-md pb-8 pt-5">
                @if (\Auth::user()->role == 'admin')
                <button data-modal-target="tambah_meja" data-modal-toggle="tambah_meja" class="capitalize  items-center py-2 px-2 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-green-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 my-5" type="button" >
                    <i class="fa-solid fa-plus"></i>
                    Tambah Meja
                </button>   
                @endif
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
                            @if ($meja->nomor_meja == 0)
                                @continue;
                            @endif
                            <tr class="hover:bg-slate-100 ">
                                <x-table-column>
                                    <div class="text-center bg-orange-400 rounded-md px-4 py-2 text-white m-2 w-fit mx-auto">
                                        {{ $meja->nomor_meja }}
                                    </div>
                                </x-table-column>
                                <x-table-column>
                                    @if ($meja->status == "ready")
                                        <div class=" flex justify-center text-center items-center py-2 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white  mx-48 uppercase">
                                            {{ $meja->status }}
                                        </div>
                                    @else
                                        <div class=" flex justify-center text-center items-center p-2 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white  mx-48 uppercase">
                                            {{ $meja->status }}
                                        </div>
                                    @endif
                                </x-table-column>
                                <x-table-column>
                                    <div class="flex justify-evenly">
                                        <form action="{{ route('meja.update',$meja->id) }} " method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-button type="submit" class="items-center py-2 px-2 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Ubah Status"  icon="fa-solid fa-pencil"/>
                                        </form>
                                        {{-- <x-button type="submit" class="items-center py-2 px-2 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                label="" onclick="toggleModal('')" icon="fa-solid fa-eye"/> --}}

                                        {{-- <x-button type="submit" class="items-center py-2 px-2 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                label="Hapus" onclick="toggleModal('hapus_meja{{ $loop->iteration }}')" icon="fa-solid fa-trash"/> --}}
                                            
                                    </div>
                                    
        
                                    {{-- Edit Meja --}}
                                    

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
                    <div id="tambah_meja" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Tambah Meja Baru
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="tambah_meja">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
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
                                        <!-- Modal footer -->
                                        <div class="flex items-center pt-6 mt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button data-modal-hide="" type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</button>
                                            <button data-modal-hide="tambah_meja" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
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