<x-layouts.auth :title="__('Client Login')">

    <!-- Login Card -->
    <div
        class="rounded-lg shadow-xl border overflow-hidden border-primary/30 bg-linear-to-br from-base-100 to-primary/5 hover:shadow-2xl transition-all duration-300">
        <div class="p-8">
            <div class="mb-6 flex flex-col items-center space-y-4">
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-primary/30 rounded-full blur-xl animate-pulse">
                    </div>
                    <div
                        class="relative p-4 bg-linear-to-br from-primary to-primary/70 rounded-full shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-12 text-white">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                </div>

                <div class="text-center space-y-2">
                    <h1
                        class="text-3xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent">
                        {{ __('Client Login') }}
                    </h1>
                    <p class="text-sm text-base-content/70">
                        {{ __('Welcome back! Sign in to your account') }}
                    </p>
                </div>
            </div>

            <form method="POST"
                action="{{ route('login') }}"
                class="space-y-4">
                @csrf

                {{-- Email input --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-base-content">
                        {{ __('Email Address') }}
                    </label>
                    <label
                        class="input w-full {{ $errors->has('email') ? 'input-error' : 'input-primary' }} hover:input-primary focus-within:input-primary transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5 text-primary">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        <input type="text"
                            name="email"
                            class="grow"
                            placeholder="email@example.com"
                            value="{{ old('email') }}"
                            autofocus />
                    </label>

                    @error('email')
                        <div role="alert"
                            class="alert alert-error shadow-lg animate-fade-in">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="stroke-current shrink-0 h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Password input --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-base-content">
                        {{ __('Password') }}
                    </label>
                    <label
                        class="input w-full {{ $errors->has('password') ? 'input-error' : 'input-primary' }} hover:input-primary focus-within:input-primary transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5 text-primary">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <input type="password"
                            name="password"
                            class="grow"
                            placeholder="••••••••" />
                    </label>

                    @error('password')
                        <div role="alert"
                            class="alert alert-error shadow-lg animate-fade-in">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="stroke-current shrink-0 h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Remember me & password reset --}}
                <div class="flex items-center justify-between pt-2">
                    {{-- Remember Me --}}
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox"
                            name="remember"
                            class="checkbox checkbox-primary checkbox-sm"
                            {{ old('remember') ? 'checked' : '' }}>
                        <span
                            class="text-sm text-base-content/70 group-hover:text-primary transition-colors">
                            {{ __('Remember me') }}
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="link link-primary link-hover text-sm font-medium">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                {{-- Client role for logging in --}}
                <input type="hidden"
                    name="role"
                    value="client">

                <!-- Login Button -->
                <button type="submit"
                    class="w-full btn btn-primary btn-lg shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300 mt-6">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-5">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    {{ __('Sign In') }}
                </button>
            </form>

            @if (Route::has('register'))
                <div class="divider">{{ __('OR') }}</div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-sm text-base-content/70">
                        {{ __('Don\'t have an account?') }}
                        <a href="{{ route('register.client') }}"
                            class="link link-primary link-hover font-semibold">
                            {{ __('Sign up for free') }}
                        </a>
                    </p>
                </div>
            @endif
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
</x-layouts.auth>
