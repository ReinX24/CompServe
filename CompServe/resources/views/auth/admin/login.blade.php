<x-layouts.auth :title="__('Admin Login')">

    <!-- Login Card with Modern Styling -->
    <div
        class="card bg-base-100 shadow-2xl border-2 border-primary/30 overflow-hidden max-w-md w-full">
        <!-- Decorative Top Border -->
        <div class="h-2 bg-gradient-to-r from-primary via-secondary to-accent">
        </div>

        <div class="card-body p-8">
            <!-- Header Section -->
            <div class="mb-6 flex flex-col items-center space-y-4">
                <!-- Admin Icon with Glow Effect -->
                <div class="relative group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-primary to-secondary rounded-full blur-xl opacity-50 group-hover:opacity-75 transition-opacity duration-300">
                    </div>
                    <div
                        class="relative bg-gradient-to-br from-primary to-secondary p-5 rounded-full shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-16 h-16 text-primary-content">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <div class="text-center">
                    <h1
                        class="text-3xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-2">
                        {{ __('Admin Login') }}
                    </h1>
                    <p class="text-base-content/60 text-sm">Access your
                        administrator dashboard</p>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST"
                action="{{ route('admin.login_admin') }}"
                class="space-y-5">
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

                {{-- Remember me & Forgot password --}}
                <div class="flex items-center justify-between">
                    {{-- Remember Me --}}
                    <label class="label cursor-pointer gap-2 p-0">
                        <input type="checkbox"
                            name="remember"
                            class="checkbox checkbox-primary checkbox-sm"
                            {{ old('remember') ? 'checked' : '' }}>
                        <span
                            class="label-text text-sm">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="link link-primary text-sm link-hover">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                {{-- Admin role hidden input --}}
                <input type="hidden"
                    name="role"
                    value="admin">

                {{-- Login Button --}}
                <button type="submit"
                    class="btn btn-primary w-full gap-2 shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    {{ __('Sign In') }}
                </button>
            </form>

            <!-- Security Notice -->
            <div class="mt-6 p-4 bg-info/10 rounded-lg border border-info/30">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-info mt-0.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-info">Secure Admin
                            Access</p>
                        <p class="text-xs text-base-content/60 mt-1">This area
                            is restricted to authorized administrators only.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
