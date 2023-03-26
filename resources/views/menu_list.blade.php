{{-- @foreach($menus as $menu)
    <div href="#" class="flex justify-center rounded-md m-4  px-2 py-5 bg-white border border-gray-300 shadow-md shadow-gray-300 hover:bg-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-48 md:w-48 md:rounded-none md:rounded-l-lg" src="{{ asset('foto_menu/'.$menu->gambar) }}" alt="" />
        <div class="bg-white p-5 ">
            <h5 class="bg-white text-2xl font-bold tracking-tight text-gray-900 dark:text-white ">{{ $menu->nama }}</h5>
            <h6 class="bg-white mb-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Rp{{ number_format($menu->harga, 2,",",".") }}</h6>
            <button type="button" onclick="addMenu('{{ $menu->nama }}','{{ $menu->id }}','{{ $menu->harga }}')" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pesan</button>
        </div>
    </div>
@endforeach --}}