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
            <div class="sm:mx-6 lg:mx-8 sm:px-6 lg:px-8 bg-red-300 rounded-md pb-8">
                
                <x-button type="submit" class="items-center py-3 px-4 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-green-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 my-5"
                label="Tambah User" onclick="toggleModal('tambah_user')" icon="fa-solid fa-plus"/>
            
                

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
                                    <x-button type="submit" class="items-center py-3 px-4 bg-blue-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Edit" onclick="toggleModal('edit_user{{ $loop->iteration }}')" icon="fa-solid fa-pencil"/>
                                   
                                    {{-- <x-button type="submit" class="items-center py-3 px-4 bg-gray-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="" onclick="toggleModal('')" icon="fa-solid fa-eye"/> --}}

                                    <x-button type="submit" class="items-center py-3 px-4 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            label="Hapus" onclick="toggleModal('hapus_user{{ $loop->iteration }}')" icon="fa-solid fa-trash"/>
                                        
                                </div>
                                 
                                {{-- Edit User --}}
                                <x-modal_edit id="edit_user{{ $loop->iteration }}" title="Edit {{ $user->username }}" form="true">
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
                                </x-modal_edit>

                                {{-- Delete User --}}
                                <x-modal_delete id="hapus_user{{ $loop->iteration }}" title="Hapus User" form="true">
                                    <form action="{{ route('user.delete',$user->id) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        Apakah anda yakin akan menghapus <span class="font-bold ">&nbsp;{{ $user->username }}&nbsp;</span> ?
                                    
                                </x-modal_delete>
                            </x-table-column>
                        </tr>
                    @endforeach
                </x-table>

                {{-- Create User --}}
                <x-modal_create id="tambah_user" title="Tambah User" form="true" >
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
                </x-modal_create>

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
