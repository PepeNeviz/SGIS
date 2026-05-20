<x-app-layout>
    @section('title', 'Detail Kelas')

    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('bk.dashboard') }}"
               class="w-9 h-9 rounded-xl border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-indigo-500 dark:text-indigo-400">Monitoring Kelas</p>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white" style="font-family:'Syne',sans-serif;">{{ $class->name }}</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-900 overflow-hidden">
                {{-- Table Header --}}
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50 flex items-center justify-between">
                    <p class="text-sm font-bold text-gray-700 dark:text-gray-300">
                        Daftar Siswa — <span class="text-indigo-600 dark:text-indigo-400">{{ $class->students->count() }} terdaftar</span>
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[11px] uppercase tracking-widest text-gray-400 dark:text-gray-500 font-bold">
                                <th class="px-6 py-4">#</th>
                                <th class="px-6 py-4">Nama Siswa</th>
                                <th class="px-6 py-4">NIS</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                            @foreach($class->students as $i => $s)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-colors group">
                                <td class="px-6 py-4 text-sm text-gray-400 dark:text-gray-500 font-mono">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($s->user->name, 0, 2)) }}
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white text-sm">{{ $s->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 font-mono">{{ $s->nis }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('bk.student.show', $s->id) }}"
                                        class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition-colors shadow-sm shadow-indigo-200 dark:shadow-indigo-900/30">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Monitoring
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>