<x-layouts.auth :title="__('Client Login')">

    <!-- Login Card -->
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="p-6">
            <div class="mb-3">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    {{ __('Log in Client Account') }}</h1>
            </div>

            <form method="POST"
                action="{{ route('login') }}"
                class="space-y-3">
                @csrf

                {{-- Email input --}}
                <label class="input input-primary w-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <input type="text"
                        name="email"
                        class="grow"
                        placeholder="johndoe@example.com"
                        value="{{ old('email') }}" />
                </label>

                <!-- Password Input -->
                {{-- <div>
                    <label for="password">Password</label>
                    <input name="password"
                        type="password"
                        class="input input-primary w-full"
                        placeholder="••••••••" />

                    <!-- Remember me & password reset -->
                    <div class="flex items-center justify-between mt-2">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs text-blue-600 dark:text-blue-400 hover:underline">{{ __('Forgot password?') }}</a>
                        @endif
                        <x-forms.checkbox label="Remember me"
                            name="remember"
                            {{ old('remember') ? 'checked' : '' }} />
                    </div>
                </div> --}}

                <div>
                    <label class="input input-primary w-full">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <input type="password"
                            name="password"
                            class="grow"
                            placeholder="••••••••" />
                    </label>

                    <!-- Remember me & password reset -->
                    <div class="flex items-center justify-between mt-2">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs text-blue-600 dark:text-blue-400 hover:underline">{{ __('Forgot password?') }}</a>
                        @endif
                        <x-forms.checkbox label="Remember me"
                            name="remember"
                            {{ old('remember') ? 'checked' : '' }} />
                    </div>
                </div>

                <div>
                    <input type="hidden"
                        name="role"
                        value="client">
                </div>

                <!-- Login Button -->
                <button
                    class="w-full btn btn-primary">{{ __('Sign In') }}</button>
            </form>

            @if (Route::has('register'))
                <!-- Register Link -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Don\'t have an account?') }}
                        <a href="{{ route('register') }}"
                            class="text-blue-600 dark:text-blue-400 hover:underline font-medium">{{ __('Sign up') }}</a>
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.auth>
