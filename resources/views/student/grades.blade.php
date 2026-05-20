<x-app-layout>
    @section('title', 'Riwayat Nilai')

    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('student.dashboard') }}" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Riwayat Nilai & Analisis Studi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-white dark:bg-gray-900 p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">
                        Analisis Studi Terkini
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Berdasarkan bimbingan terakhir dengan Guru BK, fokus studi kamu saat ini diarahkan untuk mencapai target: 
                        <span class="font-bold text-indigo-600 dark:text-indigo-400">{{ $student->recommendation_college ?? 'Belum ditentukan' }}</span>. 
                        Pastikan nilai pada mata pelajaran kejuruan tetap stabil.
                    </p>
                </div>
                
                <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 p-6 rounded-2xl text-white">
                    <p class="text-indigo-200 text-xs font-bold uppercase tracking-widest">Target Karir</p>
                    <h4 class="text-2xl font-bold mt-2">
                        {{ $student->recommendation_career ?? 'Menunggu Analisis' }}
                    </h4>
                    <p class="mt-4 text-sm opacity-80">Gunakan data nilai di bawah sebagai acuan evaluasi belajar kamu.</p>
                </div>
            </div>

            @for($i = 1; $i <= 5; $i++)
                @php
                    $semesterGrades = $student->grades->where('semester', $i);
                @endphp
                
                <div class="bg-white dark:bg-gray-900 overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-sm">Semester {{ $i }}</h3>
                        <span class="text-xs font-bold px-3 py-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-full">
                            Rata-rata: {{ $semesterGrades->count() > 0 ? round($semesterGrades->avg('score'), 1) : '-' }}
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="text-[11px] uppercase tracking-widest text-gray-400 dark:text-gray-500 font-bold">
                                <tr>
                                    <th class="px-6 py-4">Mata Pelajaran</th>
                                    <th class="px-6 py-4 text-center">Nilai</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse($semesterGrades as $grade)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-300">{{ $grade->subject->name }}</td>
                                        <td class="px-6 py-4 text-center font-bold {{ $grade->score >= 75 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500 dark:text-red-400' }}">
                                            {{ $grade->score }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($grade->score >= 75)
                                                <span class="bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 px-3 py-1 rounded-full text-xs font-medium">Tuntas</span>
                                            @else
                                                <span class="bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 px-3 py-1 rounded-full text-xs font-medium">Perbaikan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center text-gray-400 dark:text-gray-500 text-sm">
                                            Data nilai semester {{ $i }} belum diinput oleh guru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endfor

        </div>
    </div>
</x-app-layout>