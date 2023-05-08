<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
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
            <div class="sm:mx-6 lg:mx-8 sm:px-6 lg:px-8 bg-red-300 rounded-md pb-8 pt-5">
                
                <button data-modal-target="tambah_user" data-modal-toggle="tambah_user" class=" items-center py-2 px-2 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-green-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 my-5" type="button" >
                    <i class="fa-solid fa-plus"></i>
                    Tambah User
                </button>

                <x-table id="table_user">
                    <x-slot name="header">
                        <x-table-column>No</x-table-column>
                        <x-table-column>Username</x-table-column>
                        <x-table-column>Email</x-table-column>
                        <x-table-column>No Telp</x-table-column>
                        <x-table-column>Role</x-table-column>
                        <x-table-column>Aksi</x-table-column>
                    </x-slot>
                    @foreach ($user as $user)
                        <tr class="hover:bg-slate-100 ">
                            <x-table-column>
                                <div class="text-center">
                                    {{ $loop->iteration }}
                                </div>
                            </x-table-column>
                            <x-table-column>{{ $user->username }}</x-table-column>
                            <x-table-column>{{ $user->email }}</x-table-column>
                            <x-table-column>{{ $user->hp }}</x-table-column>
                            <x-table-column>{{ $user->role }}</x-table-column>
                            <x-table-column>
                                <div class="flex justify-evenly">
                                    <!-- Modal toggle -->
                                    <button data-modal-target="edit_user{{ $loop->iteration }}" data-modal-toggle="edit_user{{ $loop->iteration }}" class=" fa-solid fa-pencil items-center py-2 px-3 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="button">
                                    </button>
                                    <button data-modal-target="delete_user{{ $loop->iteration }}" data-modal-toggle="delete_user{{ $loop->iteration }}" class="fa-solid fa-trash items-center py-2 px-3 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white  tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none  focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="button">
                                    </button>  
                                </div>
                                 
                              

                                <!-- Edit User -->
                                <div id="edit_user{{ $loop->iteration }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Edit {{ $user->username }}
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit_user{{ $loop->iteration }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 space-y-6">
                                                <form action="{{ route('user.update',$user->id) }}" method="POST" class="">
                                                    @csrf
                                                    @method('PUT')
            
                                                    <!-- userName -->
                                                    <div class="mt-4">
                                                        <x-input-label for="username" :value="__('Username')" />
            
                                                        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="$user->username" required autofocus />
            
                                                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                                    </div>
            
                                                    <!-- Email Address -->
                                                    <div class="mt-4">
                                                        <x-input-label for="email" :value="__('Email')" />
            
                                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required />
            
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                    </div>
            
                                                    <!-- hp -->
                                                    <div class="mt-4">
                                                        <x-input-label for="hp" :value="__('No HP')" />
            
                                                        <x-text-input id="hp" class="block mt-1 w-full" type="text" name="hp" :value="$user->hp" required autofocus />
            
                                                        <x-input-error :messages="$errors->get('hp')" class="mt-2" />
                                                    </div>
            
                                                    <!-- Password -->
                                                    <div class="mt-4">
                                                        <x-input-label for="password" :value="__('Password')" />
            
                                                        <x-text-input id="password" class="block mt-1 w-full"
                                                                        type="password"
                                                                        name="password"/>
                                                        <span class="text-red-500 text-xs">Kosongkan Jika Tidak Diganti</span>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>
            
                                                    <!-- Confirm Password -->
                                                    <div class="mt-4">
                                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            
                                                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                                        type="password"
                                                                        name="password_confirmation" />
            
                                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                    </div>
            
                                                    <!--Role-->
                                                    <div class="mt-4">
                                                        <x-input-label for="role" :value="__('Role')" />
            
                                                        <select name="role" class="block mt-1 rounded-md">
                                                            <option value="{{ $user->role }}">{{ ucfirst($user->role) }}</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="kasir">Kasir</option>
                                                            <option value="pegawai">pegawai</option>
                                                            <option value="customer">Customer</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="flex items-center pt-6 mt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button data-modal-hide="" type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan</button>
                                                        <button data-modal-hide="edit_user{{ $loop->iteration }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>

                                {{-- Delete User --}}
                               <div id="delete_user{{ $loop->iteration }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="delete_user{{ $loop->iteration }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <form action="{{ route('user.delete',$user->id) }}" method="POST" class="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin akan menghapus <span class="font-bold ">&nbsp;{{ $user->username }}&nbsp;</span> ?</h3>
                                                    <button data-modal-hide="delete_user{{ $loop->iteration }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                        Yes, Hapus
                                                    </button>
                                                    <button data-modal-hide="delete_user{{ $loop->iteration }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, Batal</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </x-table-column>
                        </tr>
                    @endforeach
                </x-table>

                {{-- Create User --}}
                <div id="tambah_user" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Tambah User Baru
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="tambah_user">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <form action="{{ route('user.store') }}" method="POST" class="">
                                    @csrf
            
                                    <!-- userName -->
                                    <div class="mt-4">
                                        <x-input-label for="username" :value="__('Username')" />
            
                                        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            
                                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                    </div>
            
                                    <!-- Email Address -->
                                    <div class="mt-4">
                                        <x-input-label for="email" :value="__('Email')" />
            
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  required />
            
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
            
                                    <!-- hp -->
                                    <div class="mt-4">
                                        <x-input-label for="hp" :value="__('No HP')" />
            
                                        <x-text-input id="hp" class="block mt-1 w-full" type="text" name="hp" :value="old('hp')" required autofocus />
            
                                        <x-input-error :messages="$errors->get('hp')" class="mt-2" />
                                    </div>
            
                                    <!-- Password -->
                                    <div class="mt-4">
                                        <x-input-label for="password" :value="__('Password')" />
            
                                        <x-text-input id="password" class="block mt-1 w-full"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="new-password" />
            
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
            
                                    <!-- Confirm Password -->
                                    <div class="mt-4">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                        type="password"
                                                        name="password_confirmation" required />
            
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
            
                                    <!-- Role -->
                                    <div class="mt-4">
                                        <x-input-label for="role" :value="__('Role')" />
            
                                        <select name="role" class="block mt-1 rounded-md border-none">
                                                <option value="admin">Admin</option>
                                                <option value="kasir">Kasir</option>
                                                <option value="pegawai">Pegawai</option>
                                                <option value="customer">Customer</option>
                                        </select>
                                            
                                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center pt-6 mt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button data-modal-hide="" type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</button>
                                        <button data-modal-hide="tambah_user" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
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
       
    </script>
    
</x-app-layout>
