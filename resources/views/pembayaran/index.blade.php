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
                                        <x-button type="submit" class="items-center py-2 px-2 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Batal" onclick="toggleModal('hapus_pesanan{{ $loop->iteration }}')" icon="fa-solid fa-trash"/>
                                        <x-button type="submit" class="items-center py-2 px-2 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                label="Detail" onclick="toggleModal('detail_pembayaran{{ $loop->iteration }}')" icon="fa-solid fa-eye"/>    
                                        <x-button type="submit" class="items-center py-2 px-2 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                label="Bayar" onclick="toggleModal('edit_pembayaran{{ $loop->iteration }}')" icon="fa-solid fa-receipt"/>
                                    @endif
                                    @if ($pembayaran->status == "paid")
                                        <x-button type="submit" class="items-center py-2 px-2 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                        label="Detail" onclick="toggleModal('detail_pembayaran{{ $loop->iteration }}')" icon="fa-solid fa-eye"/>    

                                        <x-nav-button :href="route('struk_pembayaran',$pembayaran->id)" id="print{{ $loop->iteration }}" 
                                            class="items-center py-2 px-2 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" 
                                            icon="fa-solid fa-print" label="struk" />
                                    @endif
                                    
                                </div>
                                

                                <x-modal_bayar id="edit_pembayaran{{ $loop->iteration }}" title="Edit Status Pembayaran No {{ $pembayaran->pesanan_id }}" form="true">
                                    <form action="{{ route('pembayaran.update',$pembayaran->id) }}" method="POST" class="">
                                        @csrf
                                        @method('PUT')
                                        <table>
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
                                        </table>
                                        
                                        <div class="mt-4">
                                            <x-input-label for="tunai" :value="__('Tunai: ')" />
                                            <span class="font-medium text-sm text-gray-700">Rp</span>
                                            <x-text-input id="tunai{{ $loop->iteration }}" class="inline mt-1 w-1/2" type="number" name="tunai"  required autofocus />
                                            @if ($errors->get('tunai'))
                                            <x-input-error :messages="$errors->get('tunai')" class="mt-2" />
                                            @endif
                                            <div>
                                                <button type="button" onclick="kembalian('{{ $pembayaran->total_harga }}','{{ $loop->iteration }}')" class=" mt-5 tracking-widest bg-green-600 hover:bg-green-400 text-white active:bg-green-700 font-bold  text-sm px-3 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 fa-solid fa-check">
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

                                       

                                        
                                </x-modal_bayar>
                                
                                <x-modal_view id="detail_pembayaran{{ $loop->iteration }}" title="Detail Pesanan No {{ $pembayaran->pesanan_id }}" form="false">
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
                                </x-modal_view>

                                <x-modal_delete id="hapus_pesanan{{ $loop->iteration }}" title="Batalkan Pesanan" form="true">
                                    <form action="{{ route('pesanan.delete',$pembayaran->id) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        Apakah anda yakin akan membatalkan pesanan <span class="font-bold ">&nbsp;{{ $pembayaran->pesanan_id }}&nbsp;</span> ?
                                    
                                </x-modal_delete>
                            </x-table-column>
                        </tr>
                    @endforeach
                </x-table>

                    
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