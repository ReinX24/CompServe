{{-- Guest header for non-logged in users --}}
<header
    class="bg-white dark:bg-gray-800 shadow-sm z-40 fixed top-0 left-0 right-0 border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center justify-between h-16 px-4">
        <div class="flex items-center">
            {{-- Go to landing page --}}
            <a href="/">
                <div class="ml-4 font-semibold text-xl text-primary">
                    {{ config('app.name') }}</div>
            </a>
        </div>

        <!-- Right side: Search, notifications, profile -->
        <div class="flex items-center space-x-4">
            <div x-data="{
                theme: localStorage.getItem('appearance') || 'system',
                toggleTheme() {
                    if (this.theme === 'light') {
                        this.theme = 'dark';
                        setAppearance('dark');
                    } else if (this.theme === 'dark') {
                        this.theme = 'system';
                        setAppearance('system');
                    } else {
                        this.theme = 'light';
                        setAppearance('light');
                    }
                }
            }"
                x-init="if (theme === 'system') {
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                } else {
                    setAppearance(theme);
                }">
                <button @click="toggleTheme"
                    class="p-2 rounded-full focus:outline-none transition
            bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600">

                    <!-- Light Icon -->
                    <template x-if="theme === 'light'">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6 text-yellow-500">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                    </template>

                    <!-- Dark Icon -->
                    <template x-if="theme === 'dark'">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6 text-blue-500">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>
                    </template>

                    <!-- System Icon -->
                    <template x-if="theme === 'system'">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6 text-green-500">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                    </template>
                </button>
            </div>

            {{-- <div>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="btn btn-primary">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="btn btn-primary">
                                    Login
                                </a>
                                <a href="{{ route('register') }}"
                                    class="btn btn-secondary">
                                    Register
                                </a>
                            @endauth
                        @endif
                    </div> --}}
        </div>
    </div>
</header>
