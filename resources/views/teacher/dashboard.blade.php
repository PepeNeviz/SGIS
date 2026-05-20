<x-app-layout>
    @section('title', 'Dashboard Guru')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-indigo-500 dark:text-indigo-400 mb-1">Guru</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white" style="font-family:'Syne',sans-serif;">Pilih Kelas</h2>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 px-4 py-2 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ now()->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($classes as $class)
                <div class="bg-white dark:bg-gray-900 p-6 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-indigo-50 dark:bg-indigo-950 rounded-xl text-indigo-600 dark:text-indigo-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m4 0h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="text-xs font-bold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 px-3 py-1 rounded-full">
                            {{ $class->students_count }} Siswa
                        </span>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">{{ $class->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Rekayasa Perangkat Lunak</p>

                    <a href="{{ url('/teacher/class/'.$class->id) }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-2xl transition">
                        Buka Kelas
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>