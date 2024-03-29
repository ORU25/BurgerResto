<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan') }}
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
                {{-- @if (\Auth::user()->role == 'admin')
                <x-button type="submit" class="items-center py-3 px-4 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-green-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 my-5"
                label="Tambah Pesanan" onclick="toggleModal('tambah_pesanan')" icon="fa-solid fa-plus"/>
                @endif --}}
                
                <div class="text-xl mb-3 font-semibold text-gray-800">Belum Selesai</div>

                <x-table id="table_pesanan">
                    <x-slot name="header">
                        <x-table-column>No Pesanan</x-table-column>
                        <x-table-column>Kasir</x-table-column>
                        <x-table-column>No Meja</x-table-column>
                        <x-table-column>Tanggal</x-table-column>
                        <x-table-column>Aksi</x-table-column>
                    </x-slot>
                    
                    @foreach ($pembayaran as $pembayaran1)
                        @if ($pembayaran1->status == "paid") 
                            @if ($pembayaran1->pesanan->detail_pesanan->pluck('status')->contains('proses'))
                                <tr class="hover:bg-slate-100 ">


                                    <x-table-column>
                                        <div class="text-center">
                                            {{ $pembayaran1->pesanan->id }}
                                        </div>
                                    </x-table-column>
                                    <x-table-column>{{ $pembayaran1->pesanan->user->username }}</x-table-column>
                                    <x-table-column>
                                        @if ($pembayaran1->pesanan->meja->nomor_meja == 0)
                                            <div class="text-center">
                                                Take Away
                                            </div>
                                        @else
                                            <div class="text-center">
                                                {{ $pembayaran1->pesanan->meja->nomor_meja }}
                                            </div>
                                        @endif
                                    </x-table-column>
                                    <x-table-column>{{ $pembayaran1->pesanan->created_at }}</x-table-column>
                                    <x-table-column>
                                        <div class="flex justify-center">
                                            <button data-modal-target="detail_pesanan{{ $loop->iteration }}" data-modal-toggle="detail_pesanan{{ $loop->iteration }}" class="mx-2 items-center py-2 px-2 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"" type="button">
                                                <i class="fa-solid fa-eye"></i>
                                                Detail
                                            </button>
                                        </div>
                                        
                                    <div id="detail_pesanan{{ $loop->iteration }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Detail Pesanan No {{ $pembayaran1->pesanan_id }}
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail_pesanan{{ $loop->iteration }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-6 space-y-6">
                                                    <x-table id="tabel_detail_pesanan">
                                                        <x-slot name="header">
                                                            <x-table-column>Menu</x-table-column>
                                                            <x-table-column>Jumlah</x-table-column>
                                                            <x-table-column>Status</x-table-column>
                                                            <x-table-column>Aksi</x-table-column>
                                                        </x-slot>
                                                        @foreach ($pembayaran1->pesanan->detail_pesanan as $detail)
                                                            <tr>
                                                                <x-table-column>{{ $detail->menu->nama }}</x-table-column>
                                                                <x-table-column>{{ $detail->jumlah }}</x-table-column>
                                                                <x-table-column>{{ $detail->status }}</x-table-column>
                                                                <x-table-column>
                                                                    <div class="flex justify-center">
                                                                        <form action="{{ route('pesanan.update',$detail->id) }} " method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <x-button type="submit" class="items-center py-2 px-2 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                                            label="Ubah Status"  icon="fa-solid fa-pencil"/>
                                                                        </form>
                                                                    </div>
                                                                </x-table-column>
                                                            </tr>
                                                        @endforeach
                                                    </x-table>
                                                        <!-- Modal footer -->
                                                        <div class="flex items-center pt-6 mt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                            <button data-modal-hide="detail_pesanan{{ $loop->iteration }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tutup</button>
                                                           
                                                        </div>
                                                    </form>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>

                                        
                                    </x-table-column>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </x-table>
                <div class="text-xl my-3 font-semibold text-gray-800">Selesai</div>

                <x-table id="table_pesanan2">
                    <x-slot name="header">
                        <x-table-column>No Pesanan</x-table-column>
                        <x-table-column>Kasir</x-table-column>
                        <x-table-column>No Meja</x-table-column>
                        <x-table-column>Tanggal</x-table-column>
                        <x-table-column>Aksi</x-table-column>
                    </x-slot>
                    
                    @foreach ($pembayaran as $pembayaran2)
                        @if ($pembayaran2->status == "paid") 
                            @if (!$pembayaran2->pesanan->detail_pesanan->pluck('status')->contains('proses'))
                                <tr class="hover:bg-slate-100 ">


                                    <x-table-column>
                                        <div class="text-center">
                                            {{ $pembayaran2->pesanan->id }}
                                        </div>
                                    </x-table-column>
                                    <x-table-column>{{ $pembayaran2->pesanan->user->username }}</x-table-column>
                                    <x-table-column>
                                        @if ($pembayaran2->pesanan->meja->nomor_meja == 0)
                                            <div class="text-center">
                                                Take Away
                                            </div>
                                        @else
                                            <div class="text-center">
                                                {{ $pembayaran2->pesanan->meja->nomor_meja }}
                                            </div>
                                        @endif
                                    </x-table-column>
                                    <x-table-column>{{ $pembayaran2->pesanan->created_at }}</x-table-column>
                                    <x-table-column>
                                        <div class="flex justify-center">
                                            <button data-modal-target="detail_pesanan_done{{ $loop->iteration }}" data-modal-toggle="detail_pesanan_done{{ $loop->iteration }}" class="mx-2 items-center py-2 px-2 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"" type="button">
                                                <i class="fa-solid fa-eye"></i>
                                                Detail
                                            </button>
                                            
                                        </div>
                                        
                                        <div id="detail_pesanan_done{{ $loop->iteration }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Detail Pesanan No {{ $pembayaran2->pesanan_id }}
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail_pesanan_done{{ $loop->iteration }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 space-y-6">
                                                        <x-table id="tabel_detail_pesanan">
                                                            <x-slot name="header">
                                                                <x-table-column>Menu</x-table-column>
                                                                <x-table-column>Jumlah</x-table-column>
                                                                <x-table-column>Status</x-table-column>
                                                                
                                                            </x-slot>
                                                            @foreach ($pembayaran2->pesanan->detail_pesanan as $detail)
                                                                <tr>
                                                                    <x-table-column>{{ $detail->menu->nama }}</x-table-column>
                                                                    <x-table-column>{{ $detail->jumlah }}</x-table-column>
                                                                    <x-table-column>{{ $detail->status }}</x-table-column>
                                                                    
                                                                </tr>
                                                            @endforeach
                                                        </x-table>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center pt-6 mt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button data-modal-hide="detail_pesanan_done{{ $loop->iteration }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tutup</button>
                                                               
                                                            </div>
                                                        </form>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
            
                                        
                                    </x-table-column>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </x-table>

                    {{-- Create Pesanan --}}
                    {{-- <x-modal_create id="tambah_pesanan" title="Tambah Pesanan" form="true" >
                        <form action="{{ route('pesanan.store') }}" method="POST" class="" id="tambah_pesanan_form">
                            @csrf

                            
                                        <label for="nomor_meja" class="bg-slate-500 px-3 py-2 text-white">Pilih Nomor Meja</label>

                                        <select class="mt-3 mb-5 block  w-auto rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'" name="nomor_meja">
                                    
                                            @foreach($meja as $meja1)
                                            @if ($meja1->nomor_meja == 0)
                                                @continue;
                                            @endif
                                            @if ($meja1->status == "ready")
                                            <option value="{{ $meja1->id }}">{{$meja1->nomor_meja}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('nomor_meja')" class="mt-2" />

                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <td class="border border-gray-700 text-center font-bold bg-slate-500 text-slate-200">Nama Menu</td>
                                        <td class="border border-gray-700 text-center font-bold bg-slate-500 text-slate-200">Jumlah</td>
                                        <td class="border border-gray-700 text-center font-bold bg-slate-500 text-slate-200">Aksi</td>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr>
                                        
                                        <td class="border border-gray-700 p-3">
                                            <select class="mx-auto block mt-1 w-auto rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'" name="menu[]">
                                        
                                                @foreach($menu as $menu1)
                                                @if ($menu1->status == "ready")
                                                <option value="{{ $menu1->id }}">{{$menu1->nama}}</option>
                                                @endif
                                                @endforeach
                                            </select>
            
                                            <x-input-error :messages="$errors->get('nomor_meja')" class="mt-2" />
                                        </td>
                                        <td class="border border-gray-700 p-3">
                                            <input type="number" class="mx-auto block mt-1 w-16 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="jumlah[]" min="1" :value="old('jumlah')" required autofocus>
                                        </td>
                                        <td class="border border-gray-700 p-3 ">
                                            <div class="flex justify-center">
                                                <button onclick="addSelect()" type="button" class="items-center py-2 px-4 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-grgreen-400 active:bg-grgreen-600 focus:outline-none  focus:ring ring-grgreen-300 disabled:opacity-25 transition ease-in-out duration-150 fa-solid fa-plus">&nbsp;Tambah Menu</button>      
                                            </div>  
                                        </td>        
                                    </tr>
                                </tbody>
                            </table>
                         
                    </x-modal_create> --}}
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

        var counter = 1;
        
        function addSelect(){
            var container = document.getElementById("tbody");
            var row = document.createElement("tr");
            var column = document.createElement("td");
            var column2 = document.createElement("td");
            var column3 = document.createElement("td");
            var select = document.createElement("select");
            var input = document.createElement("input");
            var divJustify = document.createElement("div");
            var removeButton = document.createElement("button");

            row.id = "row"+counter;

            // select.id = "menu"+counter;
            select.name = "menu[]";
            select.className = "mx-auto block mt-1 w-auto rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'";

            column.className = "border border-gray-700 p-3";
            column2.className = "border border-gray-700 p-3";
            column3.className = "border border-gray-700 p-3";

            input.type = "number";
            input.className = "mx-auto block mt-1 w-16 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm";
            input.name = "jumlah[]";
            input.required = true;
            input.autofocus = true;
            input.min ="1";

            divJustify.className = "flex justify-center";

            removeButton.type = "button";
            removeButton.className = "items-center py-2 px-4 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 fa-solid fa-minus";
            


            row.appendChild(column);
            column.appendChild(select);
            row.appendChild(column2);
            column2.appendChild(input)
            row.appendChild(column3);
            column3.appendChild(divJustify)
            divJustify.appendChild(removeButton)

            var menu = @json($menu);

            
            menu.forEach(function(item){
                if(item.status === "ready"){
                    var option = document.createElement("option");
                    option.value = item.id;
                    option.text = item.nama;
                    
                    select.appendChild(option);
                }
            });

            
            removeButton.onclick = function() {
                container.removeChild(document.getElementById(row.id));
            };
            counter++
            
            container.appendChild(row);
            
        }
        
    </script>
    
    
</x-app-layout>