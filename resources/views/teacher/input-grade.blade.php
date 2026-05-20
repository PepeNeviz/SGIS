<x-app-layout>
    @section('title', 'Input Nilai')

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Input Grade: {{ $student->user->name }}
            </h2>
            <div class="text-sm px-4 py-2 font-bold text-gray-600 dark:text-gray-400">
                Kelas: {{ $student->class->name }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 bg-white dark:bg-gray-900 p-4 flex items-center justify-between">
                <span class="font-bold text-gray-700 dark:text-gray-300">Pilih Semester Aktif:</span>
                <form method="GET" id="semesterForm">
                    <select name="semester" onchange="document.getElementById('semesterForm').submit()" class="rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-indigo-500 px-3 py-2">
                        @for($i=1; $i<=5; $i++)
                            <option value="{{ $i }}" {{ $selectedSemester == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                        @endfor
                    </select>
                </form>
            </div>

            <form action="/teacher/grade" method="POST" class="bg-white dark:bg-gray-900">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <input type="hidden" name="semester" value="{{ $selectedSemester }}">

                <div class="p-6">
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($subjects as $sub)
                            @php
                                $existingGrade = \App\Models\Grade::where('student_id', $student->id)
                                    ->where('subject_id', $sub->id)
                                    ->where('semester', $selectedSemester)
                                    ->first();
                            @endphp
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-indigo-200 dark:hover:border-indigo-600 transition">
                                <label class="font-semibold text-gray-700 dark:text-gray-300">{{ $sub->name }}</label>
                                <div class="flex items-center gap-3">
                                    <input 
                                        type="number" 
                                        name="scores[{{ $sub->id }}]" 
                                        value="{{ $existingGrade ? $existingGrade->score : '' }}"
                                        min="0" max="100"
                                        placeholder="0-100"
                                        class="w-24 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-center font-bold text-indigo-600 dark:text-indigo-400 focus:ring-indigo-500 px-3 py-2"
                                    >
                                    <span class="text-gray-400 text-sm">/ 100</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex gap-4">
                        <button type="submit" class="flex-1 bg-indigo-600 text-white py-3 rounded-2xl font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-100 dark:shadow-indigo-900/30 transition duration-300">
                            Simpan Grade Semester {{ $selectedSemester }}
                        </button>
                        <a href="/teacher/dashboard" class="px-6 py-3 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-2xl font-bold hover:bg-gray-200 dark:hover:bg-gray-700 transition text-center">
                            Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>