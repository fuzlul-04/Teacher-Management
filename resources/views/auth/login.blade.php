<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h2 class="text-2xl font-bold text-white mb-6 text-center">Welcome Back</h2>

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('email') border-red-500 @enderror"
                placeholder="you@example.com">
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('password') border-red-500 @enderror"
                placeholder="••••••••">
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-6">
            <input id="remember_me" type="checkbox" class="rounded border-slate-600 bg-slate-700 text-purple-500 focus:ring-purple-500 focus:ring-offset-slate-800" name="remember">
            <label for="remember_me" class="ml-2 text-sm text-slate-400">Remember me</label>
        </div>

        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a class="text-sm text-slate-400 hover:text-white transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif

            <button type="submit" class="px-6 py-2.5 rounded-xl gradient-button text-white font-medium hover:shadow-lg hover:shadow-purple-500/25 transition-all duration-300">
                Sign In
            </button>
        </div>

        @if (Route::has('register'))
            <div class="mt-6 pt-6 border-t border-slate-700 text-center">
                <p class="text-sm text-slate-400">
                    Don't have an account?
                    <a class="text-purple-400 hover:text-purple-300 font-medium transition-colors" href="{{ route('register') }}">
                        Create one
                    </a>
                </p>
            </div>
        @endif
    </form>
</x-guest-layout>
