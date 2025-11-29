<x-layouts.auth :title="__('Forgot Password')">
    <!-- Forgot Password Card -->
    <div class="rounded-lg shadow-md border overflow-hidden border-primary">
        <div class="p-6">
            <div class="mb-6 flex flex-col items-center space-y-3">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-16 h-16">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>

                <h1 class="text-2xl font-bold">
                    {{ __('Forgot Password') }}</h1>
                <p class="text-center">
                    {{ __('Enter your email to receive a password reset link') }}
                </p>
            </div>

            @if (session('status'))
                <div
                    class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST"
                action="{{ route('password.email') }}"
                class="space-y-4">
                @csrf

                <!-- Email Input -->
                <div>
                    <label
                        class="input w-full {{ $errors->has('email') ? 'input-error' : 'input-primary' }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6 mr-2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        <input type="email"
                            name="email"
                            class="grow"
                            placeholder="your@email.com"
                            value="{{ old('email') }}" />
                    </label>
                    @error('email')
                        <div role="alert"
                            class="alert alert-error alert-soft mt-3">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>

            <!-- Back to Login -->
            <div class="text-center mt-2">
                <a href="{{ route('login') }}"
                    class="w-full btn btn-outline btn-secondary font-medium">
                    {{ __('Back to login') }}
                </a>
            </div>
        </div>
    </div>
</x-layouts.auth>
