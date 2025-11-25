<x-layouts.auth :title="__('Freelancer Register')">
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
                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>

                <h1 class="text-2xl font-bold text-center">
                    {{ __('Register Freelancer Account') }}</h1>
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
                    {{-- <x-forms.input label="Email"
                        name="email"
                        type="email"
                        placeholder="your@email.com" /> --}}

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

                {{-- Password Input --}}
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

                {{-- Confirm Password Input --}}
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

                {{-- Freelancer role registering --}}
                <div>
                    <input type="hidden"
                        name="role"
                        value="freelancer">
                </div>

                <!-- Register Button -->
                <button
                    class="w-full btn btn-primary">{{ __('Create Account') }}</button>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <a href="{{ route('login.freelancer') }}"
                        class="link link-primary">{{ __('Sign in') }}</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.auth>
