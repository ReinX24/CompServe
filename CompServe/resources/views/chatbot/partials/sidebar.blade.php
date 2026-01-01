<div class="space-y-6">

    <!-- Tips Card -->
    <div
        class="bg-white dark:bg-base-100 rounded-2xl p-6 shadow-xl border-2 border-yellow-200 dark:border-yellow-800">
        <h3
            class="font-bold text-lg flex items-center gap-2 mb-4 text-gray-800 dark:text-gray-200">
            <div
                class="w-8 h-8 bg-linear-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center">
                💡
            </div>
            Pro Tips
        </h3>
        <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span>Include <strong>specific error
                        messages</strong></span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span>Mention what you've <strong>already
                        tried</strong></span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span>Specify your <strong>device/OS
                        version</strong></span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span>Describe <strong>expected vs actual
                        behavior</strong></span>
            </li>
        </ul>
    </div>

    <!-- Session Stats -->
    <div
        class="bg-white dark:bg-base-100 rounded-2xl p-6 shadow-xl border-2 border-gray-200 dark:border-gray-700">
        <h3
            class="font-bold text-lg mb-4 text-gray-800 dark:text-gray-200 flex items-center gap-2">
            <div
                class="w-8 h-8 bg-linear-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white">
                📊
            </div>
            Session Stats
        </h3>

        <div class="grid grid-cols-2 gap-3">
            <div
                class="bg-linear-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl p-4 border border-blue-200 dark:border-blue-700">
                <div class="text-xs text-gray-600 dark:text-gray-400 mb-1">
                    Messages</div>
                <div id="message-count"
                    class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                    1</div>
            </div>

            <div
                class="bg-linear-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl p-4 border border-purple-200 dark:border-purple-700">
                <div class="text-xs text-gray-600 dark:text-gray-400 mb-1">
                    Avg Time</div>
                <div
                    class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                    <span id="avg-response">~2s</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Start -->
    <div
        class="bg-white dark:bg-base-100 rounded-2xl p-6 shadow-xl border-2 border-gray-200 dark:border-gray-700">
        <h3
            class="font-bold text-lg mb-4 text-gray-800 dark:text-gray-200 flex items-center gap-2">
            <div
                class="w-8 h-8 bg-linear-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center text-white">
                ⚡
            </div>
            Quick Start
        </h3>

        <div class="space-y-2">
            @if (Auth::user()->role === 'client')
                <button
                    class="btn btn-sm w-full justify-start rounded-xl bg-gray-50 dark:bg-base-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 border-2 border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 transition-all gap-2"
                    onclick="setQuickMessage('I want to post a gig')">
                    <span class="text-lg">✏️</span>
                    <span class="text-left flex-1">Post a gig</span>
                </button>
                <button
                    class="btn btn-sm w-full justify-start rounded-xl bg-gray-50 dark:bg-base-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 border-2 border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 transition-all gap-2"
                    onclick="setQuickMessage('My Wi-Fi is not working')">
                    <span class="text-lg">📶</span>
                    <span class="text-left flex-1">Wi-Fi
                        issues</span>
                </button>
                <button
                    class="btn btn-sm w-full justify-start rounded-xl bg-gray-50 dark:bg-base-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 border-2 border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 transition-all gap-2"
                    onclick="setQuickMessage('My printer is not responding')">
                    <span class="text-lg">🖨️</span>
                    <span class="text-left flex-1">Printer
                        problems</span>
                </button>
            @elseif (Auth::user()->role === 'freelancer')
                <button
                    class="btn btn-sm w-full justify-start rounded-xl bg-gray-50 dark:bg-base-300 hover:bg-green-50 dark:hover:bg-green-900/30 border-2 border-gray-200 dark:border-gray-600 hover:border-green-300 dark:hover:border-green-600 transition-all gap-2"
                    onclick="setQuickMessage('Review my profile and suggest improvements')">
                    <span class="text-lg">🧠</span>
                    <span class="text-left flex-1">Improve my profile</span>
                </button>

                <button
                    class="btn btn-sm w-full justify-start rounded-xl bg-gray-50 dark:bg-base-300 hover:bg-green-50 dark:hover:bg-green-900/30 border-2 border-gray-200 dark:border-gray-600 hover:border-green-300 dark:hover:border-green-600 transition-all gap-2"
                    onclick="setQuickMessage('How can I get more clients on this platform?')">
                    <span class="text-lg">🚀</span>
                    <span class="text-left flex-1">Get more clients</span>
                </button>

                <button
                    class="btn btn-sm w-full justify-start rounded-xl bg-gray-50 dark:bg-base-300 hover:bg-green-50 dark:hover:bg-green-900/30 border-2 border-gray-200 dark:border-gray-600 hover:border-green-300 dark:hover:border-green-600 transition-all gap-2"
                    onclick="setQuickMessage('Analyze my skills and suggest better positioning')">
                    <span class="text-lg">🎯</span>
                    <span class="text-left flex-1">Skill positioning</span>
                </button>

                <button
                    class="btn btn-sm w-full justify-start rounded-xl bg-gray-50 dark:bg-base-300 hover:bg-green-50 dark:hover:bg-green-900/30 border-2 border-gray-200 dark:border-gray-600 hover:border-green-300 dark:hover:border-green-600 transition-all gap-2"
                    onclick="setQuickMessage('How can I increase my ratings and trust score?')">
                    <span class="text-lg">⭐</span>
                    <span class="text-left flex-1">Improve ratings &
                        trust</span>
                </button>
            @endif
        </div>
    </div>

</div>
