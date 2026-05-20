<x-app-layout>
    @section('title', 'Dashboard BK')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-indigo-500 dark:text-indigo-400 mb-1">Bimbingan Konseling</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white" style="font-family:'Syne',sans-serif;">Pilih Kelas Monitoring</h2>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 px-4 py-2 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ now()->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-900 p-5">
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Total Kelas</p>
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 mt-1">{{ $classes->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-900 p-5">
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Total Siswa</p>
                    <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ $classes->sum('students_count') }}</p>
                </div>
            </div>

            {{-- Class Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($classes as $class)
                <a href="{{ route('bk.class.show', $class->id) }}" class="group block">
                    <div class="bg-white dark:bg-gray-900 p-6 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all duration-200">

                        <div class="flex items-start justify-between mb-5">
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950 flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:bg-indigo-600 group-hover:text-white dark:group-hover:bg-indigo-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span class="text-xs font-medium bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 px-3 py-1 rounded-full">
                                {{ $class->students_count }} Siswa
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $class->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Rekayasa Perangkat Lunak</p>

                        <div class="mt-5 flex items-center text-sm font-medium text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 transition-opacity">
                            Buka Monitoring <span class="ml-1">→</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>