<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold mb-2" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Selamat Datang! 👋
        </h2>
        <p class="text-gray-600 font-medium">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
            <div class="relative mt-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="bi bi-envelope-fill"></i>
                </span>
                <x-text-input id="email" class="block w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
            <div class="relative mt-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <x-text-input id="password" class="block w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300"
                    type="password"
                    name="password"
                    required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-4 h-4" name="remember">
                <span class="ms-2 text-sm text-gray-600 font-medium">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
            <a class="text-sm font-semibold" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;" href="{{ route('password.request') }}">
                Lupa password?
            </a>
            @endif
        </div>

        <div class="space-y-4">
            <button type="submit" class="w-full py-3 px-4 font-bold text-white rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4);">
                <i class="bi bi-box-arrow-in-right"></i> Masuk
            </button>

            <div class="text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>