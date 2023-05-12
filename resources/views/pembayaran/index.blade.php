<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran') }}
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
            <div class="sm:mx-6 lg:mx-8 sm:px-6 lg:px-8 bg-red-300 rounded-md py-8">


                <x-table id="table_pembayaran">
                    <x-slot name="header">
                        <x-table-column>No Pesanan</x-table-column>
                        <x-table-column>Status Pesanan</x-table-column>
                        <x-table-column>Total Harga</x-table-column>
                        <x-table-column>Tanggal</x-table-column>
                        <x-table-column>Status</x-table-column>
                        <x-table-column>Aksi</x-table-column>
                    </x-slot>
                    @foreach ($pembayaran as $pembayaran)
                        <tr class="hover:bg-slate-100 ">
                            <x-table-column>
                                <div class="flex justify-center">
                                    {{ $pembayaran->pesanan_id}}
                                </div>
                            </x-table-column>
                            <x-table-column>
                                    @if ($pembayaran->pesanan->meja->nomor_meja == 0)
                                        Take Away
                                    @else
                                        Dine In
                                    @endif
                            </x-table-column>
                            <x-table-column>
                                Rp{{ number_format($pembayaran->total_harga, 2,",",".") }}
                            </x-table-column>
                            <x-table-column>
                                {{ $pembayaran->pesanan->created_at}}
                            </x-table-column>
                            <x-table-column>
                                @if ($pembayaran->status == "paid")
                                    <div class=" flex justify-center text-center items-center py-2 px-2 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase mx-8 ">
                                        {{ $pembayaran->status }}
                                    </div>
                                @else
                                    <div class=" flex justify-center text-center items-center py-2 px-2 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase mx-8 ">
                                        {{ $pembayaran->status }}
                                    </div>
                                @endif
                            </x-table-column>
                            <x-table-column>
                                <div class="flex justify-evenly">
                                    @if ($pembayaran->status == "unpaid")
                                        <button data-modal-target="delete_pembayaran{{ $loop->iteration }}" data-modal-toggle="delete_pembayaran{{ $loop->iteration }}" class="items-center py-2 px-2 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="button">
                                            <i class="fa-solid fa-trash"></i>
                                            Batal
                                        </button> 
                                        <button data-modal-target="detail_pembayaran{{ $loop->iteration }}" data-modal-toggle="detail_pembayaran{{ $loop->iteration }}" class="items-center py-2 px-2 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="button">
                                            <i class="fa-solid fa-eye"></i>
                                            Detail
                                        </button> 
                                        <button data-modal-target="edit_pembayaran{{ $loop->iteration }}" data-modal-toggle="edit_pembayaran{{ $loop->iteration }}" class="items-center py-2 px-2 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="button">
                                            <i class="fa-solid fa-receipt"></i>
                                            Bayar
                                        </button> 
                                        
                                    @endif
                                    @if ($pembayaran->status == "paid")
                                        <button data-modal-target="detail_pembayaran{{ $loop->iteration }}" data-modal-toggle="detail_pembayaran{{ $loop->iteration }}" class="items-center py-2 px-2 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="button">
                                            <i class="fa-solid fa-eye"></i>
                                            Detail
                                        </button> 
                                        <x-nav-button :href="route('struk_pembayaran',$pembayaran->id)" id="print{{ $loop->iteration }}" 
                                            class="items-center py-2 px-2 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" 
                                            icon="fa-solid fa-print" label="struk" />
                                    @endif
                                    
                                </div>
                                
                                {{-- Edit pembayaran --}}
                                <div id="edit_pembayaran{{ $loop->iteration }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Pembayaran Pesanan No {{ $pembayaran->pesanan_id }}
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit_pembayaran{{ $loop->iteration }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 space-y-6">
                                                <form action="{{ route('pembayaran.update',$pembayaran->id) }}" method="POST" class="">
                                                    @csrf
                                                    @method('PUT')
                                                    {{-- <table>
                                                        <tr>
                                                            <td>
                                                                <div class="mt-4 block font-medium text-sm text-gray-700 ">
                                                                    Total Harga: 
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="mt-4 block font-medium text-md text-gray-700 px-2">
                                                                    Rp{{ number_format($pembayaran->total_harga, 2,",",".") }}
                                                                </div>
                                                            </td>
                                                            
                                                        </tr>
                                                    </table> --}}
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="font-weight: bold">Menu</td>
                                                            <td style="font-weight: bold">Harga</td>
                                                            <td style="font-weight: bold">Jumlah</td>
                                                            <td style="font-weight: bold">Total</td>
                                                        </tr>
                                                        @foreach ($pembayaran->pesanan->detail_pesanan as $detail)
                                                            <tr>
                                                                <td>
                                                                    
                                                                        {{ $detail->menu->nama }}
                                                                    
                                                                </td>
                                                                <td>
                                                                    
                                                                        Rp{{ number_format($detail->menu->harga, 2,",",".") }}
                                                                    
                                                                </td>
                                                                <td>
                                                                    
                                                                        {{ $detail->jumlah }}
                                                                    
                                                                </td>
                                                                <td>
                                                                    
                                                                        Rp{{ number_format($detail->menu->harga * $detail->jumlah, 2,",",".") }}
                                                                    
                                                                </td>
                                                            </tr>
                                                                                                    
                                                        @endforeach
                                                            
                                                            <tr style="margin-top: 10px">
                                                                <td></td>
                                                                <td></td>
                                                                <td style="font-weight: bold">Total Harga: </td>
                                                                <td>
                                                                    
                                                                        Rp{{ number_format($pembayaran->total_harga, 2,",",".") }}
                                                                    
                                                                </td>
                                                            </tr>
                                                        
                                                    </table>
                                                    
                                                    <div class="mt-4">
                                                        <x-input-label for="tunai" :value="__('Tunai: ')" />
                                                        <span class="font-medium text-sm text-gray-700">Rp</span>
                                                        <input id="tunai{{ $loop->iteration }}" class="inline mt-1 w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="number" name="tunai"  required autofocus />
                                                        @if ($errors->get('tunai'))
                                                        <x-input-error :messages="$errors->get('tunai')" class="mt-2" />
                                                        @endif
                                                        <div>
                                                            <button type="button" onclick="kembalian('{{ $pembayaran->total_harga }}','{{ $loop->iteration }}')" class=" mt-5 tracking-widest bg-green-600 hover:bg-green-400 text-white active:bg-green-700 font-bold  text-sm px-3 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 ">
                                                                <i class="fa-solid fa-check"></i>
                                                                &nbsp; Cek Kembalian
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <div class="mt-4 block font-medium text-sm text-gray-700 ">
                                                                        Kembalian: 
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="kembalian{{ $loop->iteration }}" class="mt-4 block font-medium text-md text-gray-700 px-2">
                                                                        
                                                                    </div>
                                                                </td>
                                                                
                                                            </tr>
                                                        </table>
                                                    </div>
            
                                                    <!-- Modal footer -->
                                                    <div class="flex items-center pt-6 mt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button data-modal-hide="" type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Bayar</button>
                                                        <button data-modal-hide="edit_pembayaran{{ $loop->iteration }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- detail pembayaran --}}
                                <div id="detail_pembayaran{{ $loop->iteration }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Detail Pesanan No {{ $pembayaran->pesanan_id }}
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail_pembayaran{{ $loop->iteration }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 space-y-6">
                                                <table class="mb-3">
                                                    <tr>
                                                        <td class="pr-3">Kasir</td>
                                                        <td>: {{ $pembayaran->pesanan->user->username }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pr-3">Status</td>
                                                        <td>: {{ $pembayaran->status }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pr-3">No Meja</td>
                                                        <td>: 
                                                            @if ($pembayaran->pesanan->meja->nomor_meja == 0)
                                                            take away
                                                            @else
                                                            {{ $pembayaran->pesanan->meja->nomor_meja }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pr-3">Tanggal</td>
                                                        <td>: {{ $pembayaran->pesanan->created_at }}</td>
                                                    </tr>
                                                </table>
                                                
                                                <x-table id="tabel_detail_pembayaran">
                                                    <x-slot name="header">
                                                        <x-table-column>Menu</x-table-column>
                                                        <x-table-column>Harga</x-table-column>
                                                        <x-table-column>Jumlah</x-table-column>
                                                        <x-table-column>Total</x-table-column>
                                                    </x-slot>
                                                    @foreach ($pembayaran->pesanan->detail_pesanan as $detail)
                                                        <tr>
                                                            <x-table-column>
                                                                <div class="text-center">
                                                                    {{ $detail->menu->nama }}
                                                                </div>
                                                            </x-table-column>
                                                            <x-table-column>
                                                                <div class="text-center">
                                                                    Rp{{ number_format($detail->menu->harga, 2,",",".") }}
                                                                </div>
                                                            </x-table-column>
                                                            <x-table-column>
                                                                <div class="text-center">
                                                                    {{ $detail->jumlah }}
                                                                </div>
                                                            </x-table-column>
                                                            <x-table-column>
                                                                <div class="text-center">
                                                                    Rp{{ number_format($detail->menu->harga * $detail->jumlah, 2,",",".") }}
                                                                </div>
                                                            </x-table-column>
                                                        </tr>                                           
                                                    @endforeach
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="flex justify-end px-2 py-2">Total Harga: </td>
                                                            <x-table-column>
                                                                <div class="text-center">
                                                                    Rp{{ number_format($pembayaran->total_harga, 2,",",".") }}
                                                                </div>
                                                            </x-table-column>
                                                        </tr>
                                                        @if ($pembayaran->status == "paid")  
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="flex justify-end px-2 py-2">Tunai: </td>
                                                            <x-table-column>
                                                                <div class="text-center">
                                                                    Rp{{ number_format($pembayaran->detail_pembayaran->tunai, 2,",",".") }}
                                                                </div>
                                                            </x-table-column>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="flex justify-end px-2 py-2">Kembalian: </td>
                                                            <x-table-column>
                                                                <div class="text-center">
                                                                    Rp{{ number_format($pembayaran->detail_pembayaran->kembalian, 2,",",".") }}
                                                                </div>
                                                            </x-table-column>
                                                        </tr>
                                                        @endif
                                                </x-table>
                                                    <!-- Modal footer -->
                                                    <div class="flex items-center pt-6 mt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button data-modal-hide="detail_pembayaran{{ $loop->iteration }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tutup</button>
                                                        
                                                    </div>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>

                                {{-- delete pembayaran --}}
                                <div id="delete_pembayaran{{ $loop->iteration }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="delete_pembayaran{{ $loop->iteration }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <form action="{{ route('pesanan.delete',$pembayaran->id) }}" method="POST" class="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin akan membatalkan <div class="font-bold ">pesanan &nbsp;{{ $pembayaran->pesanan_id }}&nbsp;?</div> </h3>
                                                    <button data-modal-hide="delete_pembayaran{{ $loop->iteration }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                        Yes, Hapus
                                                    </button>
                                                    <button data-modal-hide="delete_pembayaran{{ $loop->iteration }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, Batal</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-table-column>
                        </tr>
                    @endforeach
                </x-table>

                    
            </div>
        </div>
    </div>

    <script type="text/javascript">
        

        function formatRupiah(angka) {
            var rupiah = '';		
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }

        function kembalian(total_harga,loop){
            var input = document.getElementById('tunai'+loop);
        
                var tunai = input.value;
                var kembalian = tunai - total_harga;
                // document.getElementById("kembalian"+loop).innerHTML = "Rp"+kembalian;
                var kembalianFormatted = formatRupiah(kembalian);

                document.getElementById("kembalian" + loop).innerHTML = kembalianFormatted;

        }

         
        
    </script>
    
</x-app-layout>