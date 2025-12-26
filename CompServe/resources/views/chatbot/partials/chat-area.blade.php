<div class="lg:col-span-2">
    <div
        class="bg-white dark:bg-base-200 rounded-3xl shadow-2xl border-2 border-gray-200 dark:border-gray-700 overflow-hidden">

        <!-- Chat Header -->
        <div
            class="bg-linear-to-r from-blue-500 via-purple-500 to-blue-600 px-6 py-5 text-white relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full translate-x-1/2 -translate-y-1/2">
                </div>
            </div>

            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-4">
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
                        <h3 class="font-bold text-xl">CompBot
                        </h3>
                        <div
                            class="flex items-center gap-1.5 text-xs text-blue-100">
                            <div
                                class="w-2 h-2 bg-green-400 rounded-full animate-pulse">
                            </div>
                            <span>Online & Ready to Help</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="hidden sm:flex items-center gap-4 text-xs">
                    <div class="flex items-center gap-1.5 text-blue-100">
                        <svg class="w-4 h-4"
                            fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                            <path
                                d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                        </svg>
                        <span id="message-count-header"
                            class="font-semibold">1</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-blue-100">
                        <svg class="w-4 h-4"
                            fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span id="avg-response-header"
                            class="font-semibold">~2s</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Body -->
        <div id="chat-container"
            class="h-152 overflow-y-auto p-6 bg-linear-to-b from-gray-50 to-white dark:from-base-300 dark:to-base-200 space-y-5">

            <!-- Initial Bot Message -->
            <div class="chat chat-start animate-slide-in">
                <div class="chat-image avatar">
                    <div
                        class="w-10 h-10 rounded-xl bg-linear-to-br from-blue-500 to-purple-600 text-white flex items-center justify-center shadow-lg">
                        🤖
                    </div>
                </div>
                <div
                    class="chat-bubble bg-white dark:bg-base-100 text-gray-800 dark:text-gray-200 shadow-lg border border-gray-200 dark:border-gray-700 max-w-[80%]">
                    <div class="flex items-start gap-3 mb-2">
                        <div
                            class="w-8 h-8 bg-linear-to-br from-blue-100 to-purple-100 dark:from-blue-900 dark:to-purple-900 rounded-lg flex items-center justify-center shrink-0">
                            <span class="text-lg">👋</span>
                        </div>
                        <div>
                            <strong
                                class="text-blue-600 dark:text-blue-400">Welcome
                                to CompBot!</strong>
                        </div>
                    </div>
                    @if (Auth::user()->role === 'client')
                        <p class="leading-relaxed">
                            I'm here to help troubleshoot your
                            technical issues before you post a
                            job.
                            Let's run a quick diagnostic check
                            to see if we can solve your problem
                            instantly—
                            <strong
                                class="text-purple-600 dark:text-purple-400">saving
                                you time and money!</strong>
                        </p>
                    @elseif(Auth::user()->role === 'freelancer')
                        <p class="leading-relaxed">
                            I'm here to help you stay productive
                            and tackle technical issues before
                            you start a project.
                            Let's run a quick diagnostic check
                            to make sure everything runs
                            smoothly—
                            <strong
                                class="text-purple-600 dark:text-purple-400">saving
                                you time and helping you deliver
                                better results!</strong>
                        </p>
                    @endif
                    <div
                        class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-600">
                        <p class="text-sm font-medium mb-2">What
                            issue are you experiencing?</p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center gap-1 text-xs bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-2 py-1 rounded-lg">
                                <svg class="w-3 h-3"
                                    fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Instant Help
                            </span>
                            <span
                                class="inline-flex items-center gap-1 text-xs bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 px-2 py-1 rounded-lg">
                                <svg class="w-3 h-3"
                                    fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                100% Free
                            </span>
                            <span
                                class="inline-flex items-center gap-1 text-xs bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 px-2 py-1 rounded-lg">
                                <svg class="w-3 h-3"
                                    fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                24/7 Available
                            </span>
                        </div>
                    </div>
                </div>
                <div
                    class="chat-footer opacity-50 text-xs mt-1 text-gray-600 dark:text-gray-400">
                    Just now
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div
            class="border-t-2 border-gray-200 dark:border-gray-700 p-6 bg-white dark:bg-base-200">
            <form id="chat-form"
                class="space-y-3">
                <div class="flex gap-3">
                    <div class="flex-1 relative">
                        <input id="user-input"
                            type="text"
                            placeholder="Describe your technical issue in detail…"
                            class="input input-bordered w-full rounded-xl bg-gray-50 dark:bg-base-300 border-2 border-gray-200 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:outline-none transition pr-12"
                            autocomplete="off"
                            maxlength="1000"
                            required>
                        <div
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">
                            <span id="char-count">0</span>/1000
                        </div>
                    </div>

                    <button id="send-btn"
                        type="submit"
                        class="btn bg-linear-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white border-none rounded-xl px-6 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all gap-2">
                        <svg class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span id="send-text">Send</span>
                    </button>
                </div>

                <div
                    class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-blue-500"
                            fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        Be specific for better results
                    </span>
                    <span class="font-medium">Press Enter to
                        send</span>
                </div>
            </form>

            <!-- Action Buttons -->
            <div id="action-buttons"
                class="hidden mt-5 space-y-3 animate-slide-up">
                <div
                    class="bg-linear-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-xl p-4 border-2 border-blue-200 dark:border-blue-800">
                    <p
                        class="text-sm text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500"
                            fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <strong>Session Complete!</strong> What
                        would you like to do next?
                    </p>
                    <div class="flex gap-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                            @if (Auth::user()->role === 'client')
                                <!-- Post a Gig -->
                                <a href="{{ route('client.jobs.create', ['type' => 'gig']) }}"
                                    class="btn btn-success rounded-xl gap-2 hover:scale-105 transition-all shadow-lg">
                                    <svg class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />
                                    </svg>
                                    Post a Gig
                                </a>

                                <!-- Create Contract -->
                                <a href="{{ route('client.jobs.create', ['type' => 'contract']) }}"
                                    class="btn btn-outline rounded-xl gap-2 hover:scale-105 transition-all">
                                    <svg class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Create Contract
                                </a>
                            @elseif(Auth::user()->role === 'freelancer')
                                <a href="{{ route('freelancer.gigs.index') }}"
                                    class="btn btn-success rounded-xl gap-2 hover:scale-105 transition-all shadow-lg">
                                    Browse Gigs
                                </a>

                                <a href="{{ route('freelancer.contracts.index') }}"
                                    class="btn btn-outline rounded-xl gap-2 hover:scale-105 transition-all">
                                    My Contracts
                                </a>
                            @endif
                        </div>

                        <button id="restart-btn"
                            class="btn btn-outline flex-1 rounded-xl gap-2 hover:scale-105 transition-all">
                            <svg class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            New Conversation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
