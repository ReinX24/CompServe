<x-layouts.app>
    <div
        class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">

        <!-- Header -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start gap-6 border-b pb-6">
            <!-- Profile Avatar -->
            <div
                class="w-32 h-32 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-4xl font-bold text-gray-600 dark:text-gray-300">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <!-- Basic Info -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                    {{ Auth::user()->name }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 text-lg mt-1">
                    {{ ucfirst(Auth::user()->role) }}
                </p>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    Member since {{ Auth::user()->created_at->format('F Y') }}
                </p>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                Contact</h2>
            <p class="text-gray-700 dark:text-gray-300"><span
                    class="font-semibold">Email:</span> {{ Auth::user()->email }}
            </p>
            <p class="text-gray-700 dark:text-gray-300"><span
                    class="font-semibold">Number:</span>
                {{ Auth::user()->contact_number ?? 'N/A' }}
            </p>
            <p class="text-gray-700 dark:text-gray-300"><span
                    class="font-semibold">Last Updated:</span>
                {{ Auth::user()->updated_at->diffForHumans() }}</p>
        </div>

        <!-- About -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                About Me</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ Auth::user()->about_me ?? 'N/A' }}
            </p>
        </div>

        <!-- Skills -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                Skills</h2>
            <ul
                class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
                <li>Problem Solving</li>
                <li>Web Development</li>
                <li>Team Collaboration</li>
                <li>Adaptability</li>
            </ul>
        </div>

        <!-- Experience -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                Experience</h2>
            <div class="space-y-4">
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-gray-100">
                        Freelancer at {{ config('app.name') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Joined
                        {{ Auth::user()->created_at->format('F Y') }}</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-1">Worked on
                        multiple projects delivering quality solutions for
                        clients.</p>
                </div>
            </div>
        </div>

        <!-- Certifications -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                Certifications</h2>
            <div class="space-y-4">
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-gray-100">
                        Freelancer at {{ config('app.name') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Joined
                        {{ Auth::user()->created_at->format('F Y') }}</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-1">Worked on
                        multiple projects delivering quality solutions for
                        clients.</p>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <x-button tag="a"
                :href="route('freelancer.profile.edit')">Edit
                Information</x-button>
        </div>
    </div>
</x-layouts.app>
