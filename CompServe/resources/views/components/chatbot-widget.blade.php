{{-- CompBot Widget Component --}}
{{-- Usage: <x-compbot-widget /> --}}

@if (auth()->check())
    <div x-data="{
        chatOpen: false,
        showWelcome: false,
        isMinimized: false,
        hasInteracted: false,
        init() {
            // Show welcome message after 3 seconds on first visit
            setTimeout(() => {
                if (!sessionStorage.getItem('compbotWelcomeShown')) {
                    this.showWelcome = true;
                    sessionStorage.setItem('compbotWelcomeShown', 'true');

                    // Auto-hide welcome after 12 seconds
                    setTimeout(() => {
                        this.showWelcome = false;
                    }, 12000);
                }
            }, 3000);
        },
        toggleChat() {
            this.chatOpen = !this.chatOpen;
            this.showWelcome = false;
            this.hasInteracted = true;
        },
        closeWelcome() {
            this.showWelcome = false;
            sessionStorage.setItem('compbotWelcomeDismissed', 'true');
        }
    }"
        class="fixed bottom-6 right-6 z-50">

        <!-- Welcome Bubble (Auto-shows once) -->
        <div x-show="showWelcome && !chatOpen"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute bottom-24 right-0 mb-2"
            style="display: none;">
            <div class="relative max-w-sm">
                <!-- Main Card -->
                <div
                    class="bg-linear-to-br from-white to-blue-50 dark:from-base-200 dark:to-base-300 rounded-2xl shadow-2xl p-5 border-2 border-blue-200 dark:border-blue-800">
                    <button @click="closeWelcome"
                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                        <svg class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="flex items-start space-x-4">
                        <!-- Bot Avatar with Animation -->
                        <div class="shrink-0 relative">
                            <div
                                class="w-14 h-14 bg-linear-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg transform hover:scale-110 transition-transform">
                                <span class="text-2xl animate-bounce">🤖</span>
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-base-200">
                            </div>
                        </div>

                        <div class="flex-1 pt-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3
                                    class="text-lg font-bold text-gray-800 dark:text-white">
                                    👋 Hi, I'm CompBot!
                                </h3>
                            </div>
                            <p
                                class="text-sm text-gray-600 dark:text-gray-300 mb-3 leading-relaxed">
                                Having technical issues? I can help troubleshoot
                                your problem in minutes—<strong
                                    class="text-blue-600 dark:text-blue-400">before
                                    you post a job!</strong>
                            </p>

                            <!-- Quick Stats -->
                            <div class="flex items-center gap-3 mb-4 text-xs">
                                <div
                                    class="flex items-center gap-1 text-green-600 dark:text-green-400">
                                    <svg class="w-4 h-4"
                                        fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-semibold">Free</span>
                                </div>
                                <div
                                    class="flex items-center gap-1 text-blue-600 dark:text-blue-400">
                                    <svg class="w-4 h-4"
                                        fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-semibold">~2 mins</span>
                                </div>
                                <div
                                    class="flex items-center gap-1 text-purple-600 dark:text-purple-400">
                                    <svg class="w-4 h-4"
                                        fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                    <span class="font-semibold">24/7
                                        Available</span>
                                </div>
                            </div>

                            <button @click="toggleChat"
                                class="w-full bg-linear-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold px-4 py-2.5 rounded-xl transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                                <svg class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                Start Chat Now
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Decorative Arrow -->
                <div
                    class="absolute -bottom-3 right-10 w-6 h-6 bg-linear-to-br from-white to-blue-50 dark:from-base-200 dark:to-base-300 transform rotate-45 border-r-2 border-b-2 border-blue-200 dark:border-blue-800">
                </div>
            </div>
        </div>

        <!-- Enhanced Chat Prompt Card -->
        <div x-show="chatOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90 translate-y-8"
            x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90 translate-y-4"
            @click.away="chatOpen = false"
            class="absolute bottom-24 right-0 mb-2"
            style="display: none;">
            <div
                class="bg-white dark:bg-base-200 rounded-2xl shadow-2xl w-80 sm:w-96 overflow-hidden border border-gray-200 dark:border-gray-700">
                <!-- Premium Header with Gradient -->
                <div
                    class="bg-linear-to-r from-blue-500 via-purple-500 to-blue-600 p-5 text-white relative overflow-hidden">
                    <!-- Animated Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div
                            class="absolute top-0 left-0 w-40 h-40 bg-white rounded-full -translate-x-1/2 -translate-y-1/2">
                        </div>
                        <div
                            class="absolute bottom-0 right-0 w-32 h-32 bg-white rounded-full translate-x-1/2 translate-y-1/2">
                        </div>
                    </div>

                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <!-- Animated Bot Avatar -->
                            <div class="relative">
                                <div
                                    class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/30 shadow-lg">
                                    <span class="text-3xl">🤖</span>
                                </div>
                                <div
                                    class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white animate-pulse">
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl">CompBot</h3>
                                <div
                                    class="flex items-center gap-1.5 text-xs text-blue-100">
                                    <div
                                        class="w-2 h-2 bg-green-400 rounded-full animate-pulse">
                                    </div>
                                    <span>Online & Ready</span>
                                </div>
                            </div>
                        </div>
                        <button @click="chatOpen = false"
                            class="text-white/80 hover:text-white hover:bg-white/20 transition-all p-2 rounded-lg">
                            <svg class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content with Better Spacing -->
                <div
                    class="p-6 space-y-5 bg-linear-to-b from-gray-50 to-white dark:from-base-300 dark:to-base-200">
                    <!-- Welcome Message Bubble -->
                    <div class="flex items-start space-x-3">
                        <div class="shrink-0">
                            <div
                                class="w-10 h-10 bg-linear-to-br from-blue-100 to-purple-100 dark:from-blue-900 dark:to-purple-900 rounded-xl flex items-center justify-center shadow">
                                <span class="text-xl">💬</span>
                            </div>
                        </div>
                        <div
                            class="flex-1 bg-white dark:bg-base-100 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                            @if (Auth::user()->role === 'client')
                                <p
                                    class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                    Hi there! 👋 Before posting a job, let me
                                    help you troubleshoot.
                                    <strong
                                        class="text-blue-600 dark:text-blue-400">
                                        I might solve it in minutes—saving you
                                        time and money!
                                    </strong>
                                </p>
                            @elseif(Auth::user()->role === 'freelancer')
                                <p
                                    class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                    Hi there! 👋 I'm here to help you land more
                                    gigs and improve your profile.
                                    I can offer tips, tricks, and guidance on
                                    tackling projects efficiently.
                                    <strong
                                        class="text-blue-600 dark:text-blue-400">
                                        Let's optimize your chances and boost
                                        your freelance success!
                                    </strong>
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Enhanced Features Grid -->
                    <div
                        class="bg-white dark:bg-base-100 rounded-xl p-4 space-y-3 shadow-sm border border-gray-100 dark:border-gray-700">
                        <h4
                            class="text-sm font-semibold text-gray-700 dark:text-gray-300 flex items-center gap-2">
                            <svg class="w-4 h-4 text-purple-500"
                                fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            What I offer:
                        </h4>

                        <div class="space-y-2.5">
                            <div
                                class="flex items-start space-x-3 group hover:bg-blue-50 dark:hover:bg-base-300 p-2 rounded-lg transition-colors">
                                <div class="shrink-0 mt-0.5">
                                    <div
                                        class="w-6 h-6 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2.5"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <span
                                        class="text-sm font-medium text-gray-700 dark:text-gray-300">Instant
                                        AI troubleshooting</span>
                                    <p
                                        class="text-xs text-gray-500 dark:text-gray-400">
                                        Get step-by-step solutions</p>
                                </div>
                            </div>

                            <div
                                class="flex items-start space-x-3 group hover:bg-blue-50 dark:hover:bg-base-300 p-2 rounded-lg transition-colors">
                                <div class="shrink-0 mt-0.5">
                                    <div
                                        class="w-6 h-6 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2.5"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    @if (Auth::user()->role === 'client')
                                        <span
                                            class="text-sm font-medium text-gray-700 dark:text-gray-300">Smart
                                            job creation</span>
                                        <p
                                            class="text-xs text-gray-500 dark:text-gray-400">
                                            Auto-generate listings if needed</p>
                                    @elseif (Auth::user()->role === 'freelancer')
                                        <span
                                            class="text-sm font-medium text-gray-700 dark:text-gray-300">Assist
                                            with gigs or contracts</span>
                                        <p
                                            class="text-xs text-gray-500 dark:text-gray-400">
                                            AI assistance for completing gigs or
                                            contracts</p>
                                    @endif
                                </div>
                            </div>

                            <div
                                class="flex items-start space-x-3 group hover:bg-blue-50 dark:hover:bg-base-300 p-2 rounded-lg transition-colors">
                                <div class="shrink-0 mt-0.5">
                                    <div
                                        class="w-6 h-6 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2.5"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <span
                                        class="text-sm font-medium text-gray-700 dark:text-gray-300">100%
                                        Free & Fast</span>
                                    <p
                                        class="text-xs text-gray-500 dark:text-gray-400">
                                        Available 24/7, no cost</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="space-y-2.5">
                        <a href="{{ route('chatbot.index') }}"
                            class="group w-full bg-linear-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white text-center font-bold py-3.5 px-4 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 group-hover:animate-pulse"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Start CompBot Now
                        </a>

                        <button @click="chatOpen = false"
                            class="block w-full bg-gray-100 hover:bg-gray-200 dark:bg-base-300 dark:hover:bg-base-100 text-gray-700 dark:text-gray-300 text-center font-medium py-2.5 px-4 rounded-xl transition-all text-sm">
                            Maybe Later
                        </button>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="flex items-center justify-center gap-4 pt-2">
                        <div
                            class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 text-green-500"
                                fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Secure
                        </div>
                        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                        <div
                            class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 text-blue-500"
                                fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Instant
                        </div>
                        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                        <div
                            class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 text-purple-500"
                                fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                            Free
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Premium Floating Button -->
        <button @click="toggleChat"
            class="group relative w-16 h-16 bg-linear-to-br from-blue-500 via-purple-500 to-blue-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 flex items-center justify-center transform hover:scale-110 hover:rotate-3">

            <!-- Animated Ring -->
            <div
                class="absolute inset-0 rounded-2xl bg-linear-to-br from-blue-400 to-purple-400 animate-pulse opacity-50">
            </div>

            <!-- Chat Icon -->
            <div x-show="!chatOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform rotate-180 scale-0"
                x-transition:enter-end="opacity-100 transform rotate-0 scale-100"
                class="relative z-10">
                <svg class="w-8 h-8"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <!-- Enhanced Notification Badge -->
                <span class="absolute -top-1 -right-1 flex h-5 w-5">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span
                        class="relative inline-flex rounded-full h-5 w-5 bg-red-500 border-2 border-white items-center justify-center text-[10px] font-bold">!</span>
                </span>
            </div>

            <!-- Close Icon -->
            <div x-show="chatOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform rotate-180 scale-0"
                x-transition:enter-end="opacity-100 transform rotate-0 scale-100"
                class="relative z-10"
                style="display: none;">
                <svg class="w-8 h-8"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2.5"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <!-- Ripple Effect -->
            <span
                class="absolute inset-0 rounded-2xl bg-blue-300 animate-ping opacity-20"></span>
        </button>

        <!-- Enhanced Tooltip -->
        <div
            class="absolute bottom-full right-0 mb-3 mr-2 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none transform group-hover:-translate-y-1">
            <div
                class="bg-gray-900 text-white text-sm font-medium px-4 py-2.5 rounded-xl shadow-2xl whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <span class="text-lg">🤖</span>
                    <span>Need Tech Help?</span>
                </div>
                <div
                    class="absolute -bottom-1.5 right-6 w-3 h-3 bg-gray-900 transform rotate-45">
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
@endif
