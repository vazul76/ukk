    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            <div class="container mx-auto px-4 py-8">
                <!-- Search Section -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Industri</h1>
                </div>
                <div class="mb-6 flex justify-end">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Cari Industri..." 
                        class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                    >
                </div>

                <!-- Industries Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($industries as $industry)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300 dark:bg-zinc-900 dark:border-zinc-700">
                            <!-- Logo and Header -->
                            <div class="flex items-center p-4 border-b border-gray-200">
                                <div class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden dark:bg-gray-800">
                                    @if($industry->logo)
                                        <img src="{{ asset('storage/'.$industry->logo) }}" alt="Logo {{ $industry->nama }}" class="h-full w-full object-contain p-2">
                                    @else
                                        <div class="text-gray-300 text-3xl">
                                            <i class="fas fa-industry"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $industry->nama }}</h3>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-4">
                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 dark:text-slate-200">
                                    {{ $industry->bidang_usaha }}
                                </p>
                                
                                <!-- Address -->
                                <div class="flex items-start mb-2">
                                    <svg class="w-4 h-4 mt-0.5 mr-2 text-gray-400 flex-shrink-0 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-slate-300">{{ $industry->alamat }}</span>
                                </div>
                                
                                <!-- Contact -->
                                <div class="flex items-center mb-4">
                                    <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-slate-300">{{ $industry->kontak }}</span>
                                </div>
                                
                                <!-- Website Button -->
                                @if($industry->website)
                                    <a href="{{ $industry->website }}" target="_blank" class="block w-full text-center bg-gray-400 text-black-600 hover:bg-zinc-400 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                        Kunjungi Website
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <div class="text-gray-400 text-5xl mb-4">
                                <i class="fas fa-industry"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-600">Industri Tidak Ditemukan</h3>
                            @if($search)
                                <p class="text-gray-500 mt-2">Coba dengan kata kunci lain</p>
                            @endif
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $industries->links() }}
                </div>
            </div>
        </div> 
    </div>
