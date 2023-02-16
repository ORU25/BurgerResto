<div class="flex invisible overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center w-1/2 mx-auto" 
id="{{ $id }}">

    {{-- content --}}
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-gray-300 outline-none focus:outline-none">
        {{-- header --}}
        <div class="flex items-start justify-between p-5 rounded-t">
            <h3 class="text-3xl font-semibold">
                {{ $title }}
            </h3>
            <button class="" 
            onclick="toggleModal('{{ $id }}')">
                <span class=" text-gray-400 text-xl outline-none focus:outline-none fa-solid fa-x hover:text-gray-600">
                    
                </span>
            </button>
        </div>

        {{-- body --}}
        <div class="relative p-6 flex-auto">
            <p class="my-4 text-slate-500 text-lg leading-relaxed">
                {{ $slot }}
            </p>
        </div>

        {{-- footer --}}
        <div class="flex items-center justify-center p-6 border-t border-solid border-slate-200 rounded-b">
            <button class="bg-red-600 hover:bg-red-400 text-white active:bg-red-700 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button" onclick="toggleModal('{{ $id }}')">
                Batal
            </button>
            <button class="tracking-widest bg-green-600 hover:bg-green-400 text-white active:bg-green-700 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 fa-solid fa-trash"
            type="submit">
                &nbsp;Hapus
            </button>
            @if ($form)
                </form>
            @endif
        </div>
    </div>
</div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>

