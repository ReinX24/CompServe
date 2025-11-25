<x-layouts.auth :title="__('Admin Login')">

    <!-- Login Card -->
    <div class="rounded-lg shadow-md border overflow-hidden border-primary">
        <div class="p-6">
            <div class="mb-3 flex flex-col items-center space-y-3">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-16">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>

                <h1 class="text-2xl font-bold">
                    {{ __('Login Admin Account') }}</h1>
            </div>

            <form method="POST"
                action="{{ route('admin.login_admin') }}"
                class="space-y-3">
                @csrf

                {{-- Email input --}}
                <div>
                    <label
                        class="input w-full {{ $errors->has('email') ? 'input-error' : 'input-primary' }}">
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
                            placeholder="email@example.com"
                            value="{{ old('email') }}" />
                    </label>

                    @error('email')
                        <div role="alert"
                            class="alert alert-error alert-soft mt-3">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Password input --}}
                <div>
                    <label
                        class="input w-full {{ $errors->has('password') ? 'input-error' : 'input-primary' }}">
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

                    @error('password')
                        <div role="alert"
                            class="alert alert-error alert-soft mt-3">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    {{-- Remember me & password reset --}}
                    <div class="flex items-center justify-between mt-2">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="link link-primary text-sm">{{ __('Forgot password?') }}</a>
                        @endif

                        {{-- Remember Me --}}
                        <label class="flex items-center text-sm text-primary">
                            <input type="checkbox"
                                name="remember"
                                class="checkbox checkbox-primary mr-2"
                                {{ old('remember') ? 'checked' : '' }}>
                            {{ __('Remember me') }}
                        </label>
                    </div>
                </div>

                {{-- Client role for logging in --}}
                <div>
                    <input type="hidden"
                        name="role"
                        value="admin">
                </div>

                {{-- Login Button --}}
                <button
                    class="w-full btn btn-primary">{{ __('Sign In') }}</button>
            </form>
        </div>
    </div>
</x-layouts.auth>
