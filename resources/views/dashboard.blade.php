<x-layouts.app :title="__('Dashboard')">
    <div class="p-8 space-y-6">
        <h1 class="text-2xl font-bold">WELCOME</h1>

        <div class="bg-white p-6 rounded-xl shadow flex items-center space-x-6">
            {{-- Foto profil --}}
            <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="w-25 h-25 rounded-full" alt="Foto Profil">


            {{-- Informasi siswa --}}
            <div>
                <p class="text-xl font-bold">{{ auth()->user()->name }}</p>
                <p class="text-gray-700">{{ auth()->user()->email }}</p>

                @php
                    $siswa = auth()->user()->siswa;
                    $status = $siswa?->status_lapor_pkl;
                    $pkl = $siswa?->pkls()->latest()->first();
                @endphp

                <p>
                    <span class="font-semibold">Status PKL:</span>
                    @if($status === 1)
                        <span class="text-green-600">Sudah Lapor</span>
                    @else
                        <span class="text-red-600">Belum Lapor</span>
                    @endif
                </p>

                <p>
                    <span class="font-semibold">Tempat PKL:</span>
                    @if($status === 1 && $pkl?->industri)
                        {{ $pkl->industri->nama }}
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>
