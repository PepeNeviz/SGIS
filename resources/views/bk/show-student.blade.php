<x-app-layout>
    @section('title', 'Monitoring Siswa')

    @push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ url()->previous() }}"
                   class="w-9 h-9 rounded-xl border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-indigo-500 dark:text-indigo-400">Monitoring Siswa</p>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white" style="font-family:'Syne',sans-serif;">{{ $student->user->name }}</h2>
                </div>
            </div>
            <span class="hidden sm:inline-flex items-center gap-2 bg-indigo-50 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 px-4 py-2 rounded-xl text-sm font-bold border border-indigo-100 dark:border-indigo-900">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m4 0h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                {{ $student->class->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Radar + Skills row --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Radar Chart --}}
                <div class="bg-white dark:bg-gray-900 p-6">
                    <div class="mb-5">
                        <h3 class="font-bold text-gray-900 dark:text-white text-lg flex items-center gap-2">
                            <span class="p-1.5 bg-amber-50 dark:bg-amber-950 rounded-lg text-base">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </span>
                            Analisis Progres 5 Semester
                        </h3>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Perbandingan nilai antar semester</p>
                    </div>
                    <div class="relative h-80">
                        <canvas id="multiRadarChart"></canvas>
                    </div>
                </div>

                {{-- Skills --}}
                <div class="bg-white dark:bg-gray-900 p-6 flex flex-col">
                    <div class="mb-5">
                        <h3 class="font-bold text-gray-900 dark:text-white text-lg flex items-center gap-2">
                            <span class="p-1.5 bg-emerald-50 dark:bg-emerald-950 rounded-lg text-base">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            </span>
                            Eksplorasi Keahlian
                        </h3>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Skill yang dideklarasikan siswa</p>
                    </div>

                    <div class="flex flex-wrap gap-2 flex-1">
                        @forelse($student->skills as $skill)
                        <div class="group relative bg-gray-50 dark:bg-gray-800 hover:bg-white dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 hover:shadow-sm px-4 py-2 rounded-xl flex items-center gap-2.5 transition-all">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300"># {{ $skill->name }}</span>
                            <form action="/bk/student/{{ $student->id }}/skill/{{ $skill->id }}" method="POST" class="inline opacity-0 group-hover:opacity-100 transition-opacity">
                                @csrf @method('DELETE')
                                <button type="submit" title="Hapus Skill"
                                    class="p-0.5 text-gray-300 dark:text-gray-600 hover:text-red-500 dark:hover:text-red-400 rounded transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </form>
                        </div>
                        @empty
                        <div class="w-full flex items-center justify-center py-8">
                            <p class="text-sm text-gray-400 dark:text-gray-500 italic">Belum ada skill yang ditambahkan.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="mt-auto pt-5">
                        <div class="p-4 bg-indigo-950 dark:bg-indigo-950 rounded-xl text-sm text-indigo-200">
                            <div class="flex gap-3">
                                <span class="shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                </span>
                                <p class="text-xs leading-relaxed"><strong class="text-white">Panduan BK:</strong> Jika area grafik mengecil di semester terbaru, pertimbangkan untuk melakukan konseling akademik.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recommendation preview --}}
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-4">Tampilan di Dashboard Siswa</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 p-6 rounded-2xl text-white shadow-lg shadow-indigo-200 dark:shadow-indigo-900/40">
                        <div class="flex justify-between items-start">
                            <p class="text-indigo-200 text-xs font-bold uppercase tracking-widest">Rekomendasi Jurusan</p>
                        </div>
                        <h4 class="text-lg font-bold mt-3 leading-snug">{{ $student->recommendation_college ?? 'Belum ada rekomendasi' }}</h4>
                        <div class="mt-4 h-0.5 w-10 bg-white/30 rounded-full"></div>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 p-6 rounded-2xl text-white shadow-lg shadow-emerald-200 dark:shadow-emerald-900/40">
                        <div class="flex justify-between items-start">
                            <p class="text-emerald-200 text-xs font-bold uppercase tracking-widest">Potensi Karir</p>
                        </div>
                        <h4 class="text-lg font-bold mt-3 leading-snug">{{ $student->recommendation_career ?? 'Belum ada rekomendasi' }}</h4>
                        <div class="mt-4 h-0.5 w-10 bg-white/30 rounded-full"></div>
                    </div>
                </div>
            </div>

            {{-- Recommendation Form --}}
            <div class="bg-white dark:bg-gray-900 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white flex items-center gap-2">
                        Form Rekomendasi Bimbingan Karir
                    </h3>
                    @if($student->recommendation_college || $student->recommendation_career)
                        <span class="bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 px-3 py-1 rounded-full text-xs font-bold border border-emerald-200 dark:border-emerald-800 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Sudah Terisi
                        </span>
                    @else
                        <span class="bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 px-3 py-1 rounded-full text-xs font-bold border border-amber-200 dark:border-amber-800">
                            Belum Ada Rekomendasi
                        </span>
                    @endif
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('bk.student.recommend') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Rekomendasi Jurusan</label>
                        <textarea name="recommendation_college" rows="4"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm resize-none"
                            placeholder="Misal: S1 Teknik Informatika - Universitas Indonesia...">{{ $student->recommendation_college }}</textarea>
                        <p class="text-[11px] text-gray-400 dark:text-gray-500">*Isi dengan nama jurusan yang disarankan.</p>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Rekomendasi Karir / Pekerjaan</label>
                        <textarea name="recommendation_career" rows="4"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm resize-none"
                            placeholder="Misal: Fullstack Developer, Game Designer...">{{ $student->recommendation_career }}</textarea>
                        <p class="text-[11px] text-gray-400 dark:text-gray-500">*Isi dengan role pekerjaan yang sesuai dengan minat & grafik siswa.</p>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 active:scale-[0.99] text-white py-3.5 rounded-xl font-bold transition-all shadow-lg shadow-indigo-100 dark:shadow-indigo-900/30 flex items-center justify-center gap-2 text-sm">
                            Update & Simpan Rekomendasi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('multiRadarChart');
        const isDark = document.documentElement.classList.contains('dark');

        const colors = [
            'rgba(99, 102, 241, ',
            'rgba(34, 197, 94, ',
            'rgba(245, 158, 11, ',
            'rgba(239, 68, 68, ',
            'rgba(168, 85, 247, '
        ];

        const rawData = @json($chartData);
        const datasets = Object.keys(rawData).map((key, index) => {
            const color = colors[index % colors.length];
            return {
                label: 'Semester ' + key,
                data: rawData[key],
                fill: true,
                backgroundColor: color + '0.1)',
                borderColor: color + '1)',
                pointBackgroundColor: color + '1)',
                pointBorderColor: isDark ? '#111827' : '#fff',
                borderWidth: 2,
                pointRadius: 3
            };
        });

        const gridColor = isDark ? 'rgba(255,255,255,0.07)' : 'rgba(0,0,0,0.05)';
        const labelColor = isDark ? '#9ca3af' : '#4B5563';

        new Chart(ctx, {
            type: 'radar',
            data: { labels: @json($subjects), datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        suggestedMin: 0,
                        suggestedMax: 100,
                        ticks: { stepSize: 20, display: false, backdropColor: 'transparent' },
                        grid: { color: gridColor },
                        angleLines: { color: gridColor },
                        pointLabels: { font: { size: 11, weight: '600' }, color: labelColor }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 16, color: labelColor, font: { size: 12 } }
                    }
                }
            }
        });
    });
    </script>
    @endpush
</x-app-layout>