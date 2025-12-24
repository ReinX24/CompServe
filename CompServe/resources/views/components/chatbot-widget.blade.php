{{-- Chatbot Widget Component --}}
{{-- Usage: <x-chatbot-widget /> --}}

@if (auth()->check() && auth()->user()->role === 'client')
    <div x-data="{
        chatOpen: false,
        showWelcome: false,
        init() {
            // Show welcome message after 3 seconds on first visit
            setTimeout(() => {
                if (!sessionStorage.getItem('chatbotWelcomeShown')) {
                    this.showWelcome = true;
                    sessionStorage.setItem('chatbotWelcomeShown', 'true');

                    // Auto-hide welcome after 10 seconds
                    setTimeout(() => {
                        this.showWelcome = false;
                    }, 10000);
                }
            }, 3000);
        }
    }"
        class="fixed bottom-6 right-6 z-50">

        <!-- Welcome Bubble (Auto-shows once) -->
        <div x-show="showWelcome && !chatOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute bottom-20 right-0 mb-2 mr-2"
            style="display: none;">
            <div
                class="bg-white dark:bg-base-200 rounded-lg shadow-xl p-4 max-w-xs relative">
                <button @click="showWelcome = false"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="flex items-start space-x-3">
                    <div class="shrink-0">
                        <div
                            class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-xl">🤖</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p
                            class="text-sm text-gray-700 dark:text-gray-300 font-medium mb-1">
                            Need technical help?
                        </p>
                        <p
                            class="text-xs text-gray-600 dark:text-gray-400 mb-3">
                            I can help troubleshoot your issue before posting a
                            job!
                        </p>
                        <button @click="chatOpen = true; showWelcome = false"
                            class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition-colors">
                            Start Chat
                        </button>
                    </div>
                </div>
                <!-- Arrow pointing to button -->
                <div
                    class="absolute -bottom-2 right-8 w-4 h-4 bg-white dark:bg-base-200 transform rotate-45">
                </div>
            </div>
        </div>

        <!-- Chat Prompt Card -->
        <div x-show="chatOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            @click.away="chatOpen = false"
            class="absolute bottom-20 right-0 mb-2"
            style="display: none;">
            <div
                class="bg-white dark:bg-base-200 rounded-lg shadow-2xl w-80 sm:w-96 overflow-hidden border border-gray-200 dark:border-gray-700">
                <!-- Header -->
                <div
                    class="bg-linear-to-r from-blue-500 to-blue-600 p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                <span class="text-2xl">🤖</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Tech Support
                                    Assistant</h3>
                                <p class="text-xs text-blue-100">Online • Ready
                                    to help</p>
                            </div>
                        </div>
                        <button @click="chatOpen = false"
                            class="text-white/80 hover:text-white transition-colors">
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

                <!-- Content -->
                <div class="p-6 space-y-4">
                    <!-- Message Bubble -->
                    <div class="flex items-start space-x-3">
                        <div class="shrink-0">
                            <div
                                class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                <span class="text-lg">💬</span>
                            </div>
                        </div>
                        <div
                            class="flex-1 bg-gray-100 dark:bg-base-300 rounded-lg p-3">
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                Hi! Before you post a job, let me try to help
                                you troubleshoot your technical issue.
                                <strong>It's quick and might save you
                                    money!</strong>
                            </p>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5 text-green-500 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Instant troubleshooting guidance</span>
                        </div>
                        <div
                            class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5 text-green-500 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Auto-generate job listing if needed</span>
                        </div>
                        <div
                            class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5 text-green-500 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Free & takes only a few minutes</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="pt-4 space-y-2">
                        <a href="{{ route('chatbot.index') }}"
                            class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center font-semibold py-3 px-4 rounded-lg transition-colors shadow-sm">
                            Start Troubleshooting
                        </a>
                        <button @click="chatOpen = false"
                            class="block w-full bg-gray-200 hover:bg-gray-300 dark:bg-base-300 dark:hover:bg-base-100 text-gray-700 dark:text-gray-300 text-center font-medium py-2 px-4 rounded-lg transition-colors text-sm">
                            Maybe Later
                        </button>
                    </div>

                    <!-- Footer Note -->
                    <p
                        class="text-xs text-gray-500 dark:text-gray-500 text-center pt-2">
                        No sign-up required • Completely free
                    </p>
                </div>
            </div>
        </div>

        <!-- Floating Chat Button -->
        <button @click="chatOpen = !chatOpen; showWelcome = false"
            class="group relative w-16 h-16 bg-linear-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center transform hover:scale-110">

            <!-- Chat Icon -->
            <div x-show="!chatOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform rotate-90 scale-0"
                x-transition:enter-end="opacity-100 transform rotate-0 scale-100"
                class="relative">
                <svg class="w-8 h-8"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <!-- Notification Dot -->
                <span
                    class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
            </div>

            <!-- Close Icon -->
            <div x-show="chatOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform rotate-90 scale-0"
                x-transition:enter-end="opacity-100 transform rotate-0 scale-100"
                style="display: none;">
                <svg class="w-8 h-8"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <!-- Ripple Effect -->
            <span
                class="absolute inset-0 rounded-full bg-blue-400 animate-ping opacity-20"></span>
        </button>

        <!-- Tooltip on Hover -->
        <div
            class="absolute bottom-full right-0 mb-2 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
            <div
                class="bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg whitespace-nowrap">
                Need Tech Help?
                <div
                    class="absolute -bottom-1 right-4 w-2 h-2 bg-gray-900 transform rotate-45">
                </div>
            </div>
        </div>
    </div>
@endif
