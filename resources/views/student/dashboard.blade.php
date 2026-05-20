<x-app-layout>
    @section('title', 'Dashboard')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-indigo-500 dark:text-indigo-400 mb-1">Student</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white" style="font-family:'Syne',sans-serif;">Dashboard</h2>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 px-4 py-2 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ now()->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </x-slot>

    @push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Welcome Banner --}}
            <div class="p-8 rounded-2xl text-gray-700 dark:text-gray-300">
                <h2 class="text-3xl font-bold" style="font-family:'Syne',sans-serif;">
                    Halo, {{ auth()->user()->name }}
                </h2>
                <p class="opacity-90 mt-2 text-lg">
                    Berikut adalah hasil analisis perkembangan akademik dan keahlianmu.
                </p>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('student.grades') }}" class="bg-white dark:bg-gray-900 p-6 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition group">
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Rata-rata Nilai</p>
                    <h3 class="text-4xl font-black text-indigo-600 dark:text-indigo-400 mt-2">
                        {{ $student->grades->count() > 0 ? round($student->grades->avg('score'), 1) : 0 }}
                    </h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">Klik untuk lihat detail rapor</p>
                </a>

                <div class="bg-white dark:bg-gray-900 p-6">
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Skill Dikuasai</p>
                    <h3 class="text-4xl font-black text-purple-600 dark:text-purple-400 mt-2">
                        {{ $student->skills->count() }}
                    </h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">Terus tingkatkan portofoliomu</p>
                </div>

                <div class="bg-white dark:bg-gray-900 p-6 flex flex-col justify-center">
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Status Siswa</p>
                    <div class="mt-2">
                        <span class="bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 px-4 py-1 rounded-full text-sm font-bold">
                            Aktif dan Berkembang
                        </span>
                    </div>
                </div>
            </div>

            {{-- Skills --}}
            <div class="bg-white dark:bg-gray-900 p-6">
                <h3 class="font-bold text-xl mb-6 text-gray-800 dark:text-white">
                    Daftar Keahlian Kamu
                </h3>

                <div class="flex flex-wrap gap-3">
                    @forelse($student->skills as $skill)
                        <span class="bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 px-5 py-2 rounded-full font-medium text-sm hover:bg-indigo-600 dark:hover:bg-indigo-500 hover:text-white transition duration-200 cursor-default">
                            {{ $skill->name }}
                        </span>
                    @empty
                        <div class="w-full text-center py-6">
                            <p class="text-gray-400 dark:text-gray-500">Belum ada skill yang ditambahkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recommendations --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 p-6 rounded-2xl text-white">
                    <p class="text-indigo-200 text-xs font-bold uppercase tracking-widest">Rekomendasi Jurusan (BK)</p>
                    <h4 class="text-2xl font-bold mt-3">{{ $student->recommendation_college ?? 'Sedang dianalisis...' }}</h4>
                    <div class="mt-4 h-1 w-12 bg-white/30 rounded"></div>
                </div>
                <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 p-6 rounded-2xl text-white">
                    <p class="text-emerald-200 text-xs font-bold uppercase tracking-widest">Potensi Karir (BK)</p>
                    <h4 class="text-2xl font-bold mt-3">{{ $student->recommendation_career ?? 'Sedang dianalisis...' }}</h4>
                    <div class="mt-4 h-1 w-12 bg-white/30 rounded"></div>
                </div>
            </div>

            {{-- Radar Chart --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white dark:bg-gray-900 p-6">
                    <h3 class="font-bold text-2xl mb-8 text-gray-800 dark:text-white">
                        Analisis Progres 8 Penjuru
                    </h3>
                    <div class="relative h-[450px]">
                        <canvas id="multiRadarChart"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl text-white flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-6 text-gray-800 dark:text-slate-200">Petunjuk Analisis</h3>
                        <ul class="space-y-4 text-sm opacity-90 leading-relaxed">
                            <li class="flex gap-3">
                                <span class="text-gray-400">-</span>
                                <span class="text-gray-900 dark:text-gray-300">Grafik menunjukkan perkembangan nilai dari <b>Semester 1 sampai 5</b>.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-gray-400">-</span>
                                <span class="text-gray-900 dark:text-gray-300">Klik label semester di bagian atas untuk menyembunyikan/menampilkan data.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-amber-400">-</span>
                                <span class="text-gray-900 dark:text-gray-300">Semakin lebar area yang terisi, semakin baik penguasaanmu di mapel tersebut.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-8 p-4 bg-black dark:bg-white/5 rounded-2xl border border-white/10 text-xs italic opacity-60">
                        Data diperbarui secara otomatis setiap kali guru menginput nilai baru.
                    </div>
                </div>
            </div>

            {{-- Add Skill Form --}}
            <div class="bg-white dark:bg-gray-900 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 dark:text-white">Tambah Keahlian Baru</h3>
                </div>

                <form action="{{ route('student.skills.add') }}" method="POST">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input 
                                type="text" name="skill_name" list="rpl-skills"
                                placeholder="Ketik skill (Misal: Laravel, Figma, Public Speaking...)" 
                                class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white py-3 px-5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                required
                            >
                            <datalist id="rpl-skills">
                                <option value="HTML & CSS">
                                <option value="JavaScript">
                                <option value="PHP (Laravel)">
                                <option value="Java (Spring/Android)">
                                <option value="Python (Data Science)">
                                <option value="MySQL/Database">
                                <option value="UI/UX Design (Figma)">
                                <option value="Unity 3D">
                                <option value="Public Speaking">
                                <option value="Technical Writing">
                            </datalist>
                        </div>
                        
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold transition active:scale-[0.98]">
                            Simpan
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
        const labels = @json($subjects);

        const datasets = [];
        
        for (let i = 1; i <= 5; i++) {
            if (rawData[i]) {
                const color = colors[i-1];
                datasets.push({
                    label: 'Semester ' + i,
                    data: rawData[i],
                    fill: true,
                    backgroundColor: color + '0.1)',
                    borderColor: color + '1)',
                    pointBackgroundColor: color + '1)',
                    pointBorderColor: isDark ? '#111827' : '#fff',
                    borderWidth: 2
                });
            }
        }

        const gridColor = isDark ? 'rgba(255,255,255,0.07)' : 'rgba(0,0,0,0.05)';
        const labelColor = isDark ? '#9ca3af' : '#4B5563';

        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { display: true, color: gridColor },
                        suggestedMin: 0,
                        suggestedMax: 100,
                        ticks: { stepSize: 20, display: false },
                        pointLabels: {
                            font: { size: 11, weight: 'bold', family: 'sans-serif' },
                            color: labelColor
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { 
                            usePointStyle: true, 
                            padding: 20,
                            color: isDark ? '#d1d5db' : '#4B5563'
                        }
                    }
                }
            }
        });
    });
    </script>
    @endpush
</x-app-layout>