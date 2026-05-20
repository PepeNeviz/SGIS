<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white" style="font-family:'Syne',sans-serif;">Buat akun baru</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Daftarkan dirimu ke sistem SGIS</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm font-medium"
                placeholder="Masukkan nama lengkap">
            @if($errors->get('name'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm font-medium"
                placeholder="nama@sekolah.ac.id">
            @if($errors->get('email'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm font-medium"
                placeholder="Min. 8 karakter">
            @if($errors->get('password'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm font-medium"
                placeholder="Ulangi password">
            @if($errors->get('password_confirmation'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-indigo-900/50 text-sm tracking-wide">
            Daftar Sekarang →
        </button>

        <p class="text-center text-sm text-gray-500 dark:text-gray-400">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 font-semibold hover:text-indigo-700">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>