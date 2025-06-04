<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-1">
        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar PKL</h1>
            </div>
            <div class="py-24">
                {{-- Card --}}
                <div class="mx-auto bg-white rounded-lg shadow-md overflow-hidden px-4 py-4 dark:bg-zinc-900">

                    {{-- tampilan pesan --}}
                    <div>
                        @if (session()->has('error'))
                            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="p-4 bg-red-500 text-white rounded-md">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session()->has('success'))
                            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="p-4 bg-green-500 text-white rounded-md">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    {{-- ./tampilan pesan --}}

                    {{-- ./Judul --}}

                    {{-- Form Entry dan Searching --}}
                    <div class="mx-auto flex items-center justify-between bg-white p-6 rounded-lg    dark:bg-zinc-900">

                        <!-- Tombol Create Lapor PKL di kiri -->
                        @role('siswa')
                            <button wire:click="create()" class="bg-gray-400 text-black px-4 py-2 rounded-lg hover:bg-zinc-400 dark:text-white">
                                Lapor PKL
                            </button>
                        @endrole
                        {{-- ./Tombol Create Lapor PKL di kiri --}}

                        {{-- cek apakah menampilkan halaman modal --}}
                        @if($isOpen)
                            @include('livewire.front.pkl.create')
                        @endif
                        {{-- ./cek apakah menampilkan halaman modal --}}

                        {{-- form searching --}}
                        <input wire:model.live="search" type="text" placeholder="Search ..." class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                        {{-- ./form searching --}}
                    </div>
                    {{-- ./Form Entry dan Searching --}}

                    {{-- Table PKL --}}
                    <table class="min-w-full bg-white dark:bg-zinc-900">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600 dark:text-white">No</th>
                                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600 dark:text-white">Nama Siswa</th>
                                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600 dark:text-white">Industri</th>
                                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600 dark:text-white">Bidang Usaha</th>
                                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600 dark:text-white">Guru Pembimbing</th>
                                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600 dark:text-white">Mulai</th>
                                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600 dark:text-white">Selesai</th>
                                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600 dark:text-white">Durasi (Hari)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use Carbon\Carbon;
                                $no = 0;
                            @endphp

                            @foreach($pkls as $key => $pkl)
                                @php
                                    $no++;
                                    $d1 = Carbon::parse($pkl->mulai);
                                    $d2 = Carbon::parse($pkl->selesai);
                                    $selisihHari = $d1->diffInDays($d2); // Selisih dalam hari
                                @endphp
                                <tr class="">
                                    {{-- <td class="px-4 py-2 border-b border-gray-200">{{ $pkl->id }}</td> --}}
                                    <td class="px-4">{{ $no }}</td>
                                    <td class="px-4">{{ $pkl->siswa->nama }}</td>
                                    <td class="px-4">{{ $pkl->industri->nama }}</td>
                                    <td class="px-4">{{ $pkl->industri->bidang_usaha }}</td>
                                    <td class="px-4">{{ $pkl->guru->nama ?? '-' }}</td>
                                    <td class="px-4">{{ $pkl->mulai }}</td>
                                    <td class="px-4">{{ $pkl->selesai }}</td>
                                    <td class="px-4">{{ $selisihHari }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- ./Table PKL --}}

                    {{-- pagination --}}
                    <div class="p-4">
                        {{ $pkls->links() }}
                    </div>
                    {{-- pagination --}}
                </div>
                {{-- ./Card --}}
            </div>
        </div>
    </div>
</div>