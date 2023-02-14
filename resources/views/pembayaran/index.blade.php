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
                {{ session('errors') }}
            </div>
        @endif

        <div class="max-w-7xl bg-slate-100 mx-auto py-5">
            <div class="sm:mx-6 lg:mx-8 sm:px-6 lg:px-8 bg-red-300 rounded-md py-8">


                <x-table id="table_pembayaran">
                    <x-slot name="header">
                        <x-table-column>No Pesanan</x-table-column>
                        <x-table-column>Total Harga</x-table-column>
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
                            <x-table-column>Rp{{ number_format($pembayaran->total_harga, 2,",",".") }}</x-table-column>
                            <x-table-column>
                                @if ($pembayaran->status == "paid")
                                    <div class=" flex justify-center text-center items-center p-4 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase mx-8 ">
                                        {{ $pembayaran->status }}
                                    </div>
                                @else
                                    <div class=" flex justify-center text-center items-center p-4 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase mx-8 ">
                                        {{ $pembayaran->status }}
                                    </div>
                                @endif
                            </x-table-column>
                            <x-table-column>
                                <div class="flex justify-evenly">
                                    <x-button type="submit" class="items-center py-3 px-4 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Detail" onclick="toggleModal('detail_pembayaran{{ $loop->iteration }}')" icon="fa-solid fa-eye"/>    
                                    <x-button type="submit" class="items-center py-3 px-4 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Edit" onclick="toggleModal('edit_pembayaran{{ $loop->iteration }}')" icon="fa-solid fa-pencil"/>
                                    @if ($pembayaran->status == "paid")
                                        
                                        <x-nav-button :href="route('print_struk',$pembayaran->id)" id="print{{ $loop->iteration }}" 
                                            class="items-center py-3 px-4 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" 
                                            icon="fa-solid fa-print" label="struk" />
                                    @endif
                                    
                                </div>
                                

                                <x-modal_edit id="edit_pembayaran{{ $loop->iteration }}" title="Edit Status Pembayaran No {{ $pembayaran->pesanan_id }}" form="true">
                                    <form action="{{ route('pembayaran.update',$pembayaran->id) }}" method="POST" class="">
                                        @csrf
                                        @method('PUT')

                                        <!-- status -->
                                        <div class="mt-4">
                                            <x-input-label for="status" :value="__('Status')" />

                                            <select name="status" class="block mt-1  rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                                <option value="{{ $pembayaran->status }}">{{ $pembayaran->status }}</option>
                                                <option value="unpaid">Unpaid</option>
                                                <option value="paid">Paid</option>
                                            </select>
                                            @if ($errors->get('status'))
                                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                
                                            @endif
                                        </div>

                                        
                                </x-modal_edit>
                                
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
                                            <td>: {{ $pembayaran->pesanan->meja->nomor_meja }}</td>
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
                                                <td class="flex justify-center py-2">Total Harga: </td>
                                                <x-table-column>
                                                    <div class="text-center">
                                                        Rp{{ number_format($pembayaran->total_harga, 2,",",".") }}
                                                    </div>
                                                </x-table-column>
                                            </tr>
                                    </x-table>
                                </x-modal_view>
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
    </script>
    
</x-app-layout>