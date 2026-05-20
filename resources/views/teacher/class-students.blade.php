<x-app-layout>
    @section('title', 'Siswa Kelas')

    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url('/teacher/dashboard') }}" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Siswa Kelas {{ $class->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 text-gray-700 dark:text-gray-300 uppercase text-xs font-bold">
                        <tr>
                            <th class="py-4 px-6">Nama Siswa</th>
                            <th class="py-4 px-6">NIS</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($class->students as $student)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="py-4 px-6 font-medium text-gray-900 dark:text-white">{{ $student->user->name }}</td>
                            <td class="py-4 px-6 text-gray-600 dark:text-gray-400">{{ $student->nis }}</td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ url('/teacher/grade/'.$student->id) }}" class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Input Grade
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>