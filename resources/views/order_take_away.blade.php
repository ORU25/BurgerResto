<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('image/logo_BR.png') }}" type="image/x-icon"/>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Burger Resto</title>
</head>
<body class="bg-red-300">  
    <div class="flex justify-between max-w-screen-2xl mx-auto min-h-screen">
    
        <div class="w-1/3 bg-red-300 max-h-screen p-4">
            <div class="bg-white h-full shadow-lg shadow-gray-400 py-3  overflow-auto">
                <h1  class="text-center text-black font-bold text-4xl " >PESANAN ANDA</h1>
                <h1  class="text-center text-black font-bold text-2xl mt-5" >Bawa Pulang</h1>
                <div class="grid grid-rows-1 my-4 mx-4"> 
                    
                    <form action="{{ route('storePesananTakeAway') }}" method="POST" id="tambah_pesan" >
                        @csrf
                       
                        <label for="pilihan" class="my-4 block mb-2 text-md font-medium text-gray-900 dark:text-white">
                            PESANAN:
                        </label>
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <td class="px-2 py-2 w-2/6 border border-gray-300 bg-gray-200 ">Menu</td>
                                    <td class="px-2 py-2 w-1/6 border border-gray-300 bg-gray-200 ">Jumlah</td>
                                    <td class="px-2 py-2 w-2/6 border border-gray-300 bg-gray-200 ">Harga</td>
                                    <td class="px-2 py-2 w-1/6 border border-gray-300 bg-gray-200 ">
                                        <div class="flex justify-center">
                                            <div class="fa-solid fa-cart-shopping"></div>
                                        </div>
                                    </td>
                                    
                                   
                                </tr>
                            </thead>
                            <tbody id="tbody">
                               
                            </tbody>
                        </table>
                        <div class="my-4 mx-2">
                           Total Harga:  <span id="totalHarga" ></span>
                        </div>
                        <div class="flex items-center justify-left py-6 px-2 border-t border-solid border-slate-200 rounded-b">
                            {{-- <button class="tracking-widest bg-green-600 hover:bg-green-400 text-white active:bg-green-700 font-bold text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 fa-solid fa-plus"
                            type="submit">
                                &nbsp;Pesan
                            </button> --}}
                            <!-- Modal toggle -->
                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="tracking-widest bg-green-600 hover:bg-green-400 text-white active:bg-green-700 font-bold text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 " type="button">
                                <i class="fa-solid fa-plus"></i>
                                Pesan
                            </button>
                            
  
                        </div>
                        <div class="flex items-center justify-start  px-2 ">
                            <a href="{{ route('pesanan.order') }}" class="tracking-widest bg-blue-600 hover:bg-blue-400 text-white active:bg-blue-700  text-sm px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                <i class=" fa-solid fa-left-long"></i>
                                &nbsp;Kembali
                            </a>
                        </div>

                        
                        
                        
                        <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-6 text-center">
                                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda sudah yakin dengan pesanan anda ?</h3>
                                        <button class="text-white bg-green-600 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="submit">
                                            <i class="fa-solid fa-plus"></i>
                                            &nbsp;Iya, Pesan
                                        </button>
                                        <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak, Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
  

                        
                    </form> 
                   
                </div>
                @if (session('sukses'))
                <div class="w-1/2 bg-green-500 flex flex-col items-center font-bold text-gray-200 rounded-md my-3 py-3 mx-auto">
                    {{ session('sukses') }}
                </div>
                @elseif(session('errors'))
                    <div class="w-1/2 bg-red-500 flex flex-col items-center font-bold text-gray-200 rounded-md my-3 py-3 mx-auto">
                        {{ session('errors') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="w-2/3 bg-red-300  overflow-auto max-h-screen">
            <div id="animation-carousel" class="relative mx-4 my-4" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden md:h-96">
                    <!-- Item 1 -->
                    <div class="hidden duration-200 ease-linear" data-carousel-item>
                        <img src="{{ asset('image/Banner1.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-200 ease-linear" data-carousel-item>
                        <img src="{{ asset('image/BannerMurah.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-200 ease-linear" data-carousel-item="active">
                        <img src="{{ asset('image/BANNER3.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
            <select name="kategori" id="kategori" onchange="filterMenu()" class="mx-4 block mt-1 w-auto rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                <option value="0">Semua Menu</option>
                @foreach ($kategori as $kategori2)
                    <option value="{{ $kategori2->id }}">{{ $kategori2->nama_kategori }}</option>
                @endforeach
            </select>
            <div class="grid grid-cols-2" id="menu-list">
                @foreach ($kategori as $kategori2)
                    @foreach($kategori2->menu as $menu)
                    <button type="button" onclick="addMenu('{{ $menu->nama }}','{{ $menu->id }}','{{ $menu->harga }}')" class="hover:bg-white hover:bg-opacity-20 rounded-lg" data-kategori-id="{{ $menu->kategori_id }}">
                        <div href="#" class="grid grid-cols-2 rounded-md m-4  px-2 py-5 bg-white border border-gray-300 shadow-md shadow-gray-300  dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300" >
                            <img class="object-cover w-44 rounded-t-lg h-44 md:rounded-none md:rounded-l-lg" src="{{ asset('foto_menu/'.$menu->gambar) }}" alt="" />
                            <div class="bg-white p-5 ">
                                <h5 class="bg-white mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-left">{{ $menu->nama }}</h5>
                                <h6 class="bg-white text-xl font-bold tracking-tight text-gray-900 dark:text-white text-left">Rp{{ number_format($menu->harga, 2,",",".") }}</h6>
                                {{-- <button type="button" onclick="addMenu('{{ $menu->nama }}','{{ $menu->id }}','{{ $menu->harga }}')" class="inline-flex items-center px-6 py-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pesan</button> --}}
                            </div>
                        </div>
                    </button>
                    @endforeach
                @endforeach
            </div>
        </div>

        

 
  
        

    </div>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script type="text/javascript">
        function toggleModal(modalID){
            document.getElementById(modalID).classList.toggle("invisible");
            document.getElementById(modalID + "_backdrop").classList.toggle("invisible");
            document.getElementById(modalID).classList.toggle("flex");
            document.getElementById(modalID + "_backdrop").classList.toggle("flex");
        }

        var counter = 1;
        var total = 0;
        
        function addMenu(menu,menu_id,harga){
            var container = document.getElementById("tbody");
            
            var row = document.createElement("tr");
            var column = document.createElement("td");
            var column2 = document.createElement("td");
            var column3 = document.createElement("td");
            var column4 = document.createElement("td");
            var input = document.createElement("input");
            var input2 = document.createElement("input");
            var divJustify = document.createElement("div");
            var removeButton = document.createElement("button");
            var namaMenu = document.createElement("div");
            var DivHargaMenu = document.createElement("div");
            var hargaMenu = document.createElement("span");

            row.id = "row"+counter;
            harga = parseInt(harga);

            column.className ="border border-gray-300 px-2 py-2"
            column2.className ="border border-gray-300 px-2 py-2"
            column3.className ="border border-gray-300 px-2 py-2"
            column4.className ="border border-gray-300 px-2 py-2"

            namaMenu.className = "ml-2 block mt-1 w-16  rounded-md shadow-sm w-full";
            namaMenu.innerHTML = menu;

            DivHargaMenu.className = "ml-2 block mt-1 w-16  rounded-md shadow-sm w-full inline";
            DivHargaMenu.innerHTML ="Rp";
            hargaMenu.className = "harga";
            hargaMenu.innerHTML =harga;

            input.type = "hidden";
            input.className = "mx-auto block mt-1 w-16  rounded-md shadow-sm w-full";
            input.name = "menu[]";
            input.readOnly = true;
            input.value = menu_id;
            
            

            input2.type = "number";
            input2.className = "mx-auto block mt-1 w-16  rounded-md shadow-sm";
            input2.name = "jumlah[]";
            input2.required = true;
            input2.autofocus = true;
            input2.min ="1";
            input2.value = 1;

            divJustify.className = "flex justify-center";

            removeButton.type = "button";
            removeButton.className = "items-center py-2 px-4 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 fa-solid fa-minus";
            


            row.appendChild(column);
            column.appendChild(input);
            column.appendChild(namaMenu);
            row.appendChild(column2);
            column2.appendChild(input2)
            row.appendChild(column3);
            column3.appendChild(DivHargaMenu);
            column3.appendChild(hargaMenu);
            row.appendChild(column4);
            column4.appendChild(divJustify);
            divJustify.appendChild(removeButton);

          
            input2.onchange = function() {
                var jumlah = input2.value;
                var totalHarga = jumlah * harga;
                hargaMenu.innerHTML = totalHarga;
                updateTotal();
            };
            
            removeButton.onclick = function() {
                container.removeChild(document.getElementById(row.id));
                
                updateTotal();
            };
            counter++
            
            container.appendChild(row);

            updateTotal();
            
        }

        function updateTotal() {
            total = 0;
            // var jumlah = document.getElementsByName("jumlah[]");
            var harga = document.getElementsByClassName("harga");

            for (var i = 0; i < harga.length; i++) {
                total += parseInt(harga[i].innerHTML);
                
            }

            document.getElementById("totalHarga").innerHTML = "Rp"+total;
        }

        function filterMenu() {
        var kategoriId = document.getElementById('kategori').value;
        var menuList = document.getElementById('menu-list').children;

        for (var i = 0; i < menuList.length; i++) {
            if (kategoriId == 0) {
                menuList[i].style.display = 'grid';
            } else if (menuList[i].getAttribute('data-kategori-id') == kategoriId) {
                menuList[i].style.display = 'grid';
            } else {
                menuList[i].style.display = 'none';
            }
        }
    }

    </script>
</body>
