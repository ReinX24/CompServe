<x-layouts.auth :title="__('Freelancer Register')">
    <div
        class="rounded-lg shadow-xl border overflow-hidden border-primary/30 bg-linear-to-br from-base-100 to-primary/5 hover:shadow-2xl transition-all duration-300">
        <div class="p-8">
            <div class="mb-6 flex flex-col items-center space-y-4">
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-accent/30 rounded-full blur-xl animate-pulse">
                    </div>
                    <div
                        class="relative p-4 bg-linear-to-br from-accent to-accent/70 rounded-full shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-12 text-white">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                </div>

                <div class="text-center space-y-2">
                    <h1
                        class="text-3xl font-bold bg-linear-to-r from-accent to-primary bg-clip-text text-transparent">
                        {{ __('Create Freelancer Account') }}
                    </h1>
                    <p class="text-sm text-base-content/70">
                        {{ __('Join CompServe and start finding work today') }}
                    </p>
                </div>
            </div>

            <form method="POST"
                action="{{ route('register') }}"
                class="space-y-4">
                @csrf

                {{-- Full Name Input --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-base-content">
                        {{ __('Full Name') }}
                    </label>
                    <label
                        class="input w-full {{ $errors->has('name') ? 'input-error' : 'input-primary' }} hover:input-primary focus-within:input-primary transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5 text-primary">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <input type="text"
                            name="name"
                            class="grow"
                            placeholder="John Doe"
                            value="{{ old('name') }}"
                            autofocus />
                    </label>

                    @error('name')
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

                <!-- Email Input -->
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
                        <input type="email"
                            name="email"
                            class="grow"
                            placeholder="your@email.com"
                            value="{{ old('email') }}" />
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

                <!-- Password Input -->
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

                    <p
                        class="text-xs text-base-content/60 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __('Must be at least 8 characters') }}
                    </p>
                </div>

                <!-- Confirm Password Input -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-base-content">
                        {{ __('Confirm Password') }}
                    </label>
                    <label
                        class="input input-primary w-full hover:input-primary focus-within:input-primary transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="size-5 text-primary">
                            <path fill-rule="evenodd"
                                d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="password"
                            name="password_confirmation"
                            class="grow"
                            placeholder="Re-enter password" />
                    </label>
                </div>

                {{-- Freelancer role registering --}}
                <input type="hidden"
                    name="role"
                    value="freelancer">

                <!-- Register Button -->
                <button type="submit"
                    class="w-full btn btn-accent btn-lg shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300 mt-6">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-5">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    {{ __('Create Account') }}
                </button>
            </form>

            <div class="divider">{{ __('OR') }}</div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-sm text-base-content/70">
                    {{ __('Already have an account?') }}
                    <a href="{{ route('login.freelancer') }}"
                        class="link link-primary link-hover font-semibold">
                        {{ __('Sign in') }}
                    </a>
                </p>
            </div>
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
