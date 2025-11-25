<x-layouts.auth :title="__('Client Register')">
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
                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>

                <h1 class="text-2xl font-bold text-center">
                    {{ __('Register Client Account') }}</h1>
            </div>

            <form method="POST"
                action="{{ route('register') }}"
                class="space-y-3">
                @csrf
                {{-- Full Name Input --}}
                <div>
                    <label
                        class="input w-full {{ $errors->has('name') ? 'input-error' : 'input-primary' }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <input type="text"
                            name="name"
                            class="grow"
                            placeholder="{{ __('Full Name') }}"
                            value="{{ old('name') }}" />
                    </label>

                    @error('name')
                        <div role="alert"
                            class="alert alert-error alert-soft mt-3">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Email Input -->
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

                <!-- Password Input -->
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
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <label
                        class="input w-full {{ $errors->has('password') ? 'input-error' : 'input-primary' }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="size-6">
                            <path fill-rule="evenodd"
                                d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="password"
                            name="password_confirmation"
                            class="grow"
                            placeholder="Re-enter Password" />
                    </label>
                </div>

                {{-- Client role registering --}}
                <div>
                    <input type="hidden"
                        name="role"
                        value="client">
                </div>

                <!-- Register Button -->
                <button
                    class="w-full btn btn-primary">{{ __('Create Account') }}</button>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <a href="{{ route('login.client') }}"
                        class="link link-primary">{{ __('Sign in') }}</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.auth>
