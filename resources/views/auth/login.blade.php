<x-guest-layout>
    <x-auth-session-status class="mb-5 text-sm font-semibold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 px-4 py-2.5 rounded-xl border border-green-200 dark:border-green-800" :status="session('status')" />

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white" style="font-family:'Syne',sans-serif;">Selamat datang kembali</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Masuk untuk melanjutkan ke dashboard SGIS</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm font-medium"
                placeholder="nama@sekolah.ac.id">
            @if($errors->get('email'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm font-medium"
                placeholder="••••••••">
            @if($errors->get('password'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 bg-gray-50 dark:bg-gray-800">
                <span class="text-sm text-gray-600 dark:text-gray-400">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold hover:text-indigo-700">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-indigo-900/50 text-sm tracking-wide">
            Masuk →
        </button>
    </form>
</x-guest-layout>