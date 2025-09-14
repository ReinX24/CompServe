<x-layouts.app>
    <div
        class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">

        <!-- Header -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start gap-6 border-b pb-6">
            <!-- Profile Avatar -->
            <div
                class="w-32 h-32 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-4xl font-bold text-gray-600 dark:text-gray-300">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <!-- Basic Info -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                    {{ $user->name }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 text-lg mt-1">
                    {{ ucfirst($user->role) }}
                </p>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    Member since {{ $user->created_at->format('F Y') }}
                </p>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                Contact</h2>
            <p class="text-gray-700 dark:text-gray-300"><span
                    class="font-semibold">Email:</span> {{ $user->email }}</p>
            <p class="text-gray-700 dark:text-gray-300"><span
                    class="font-semibold">Number:</span>
                {{ $freelancerInfo->contact_number ?? 'N/A' }}
            </p>
            <p class="text-gray-700 dark:text-gray-300"><span
                    class="font-semibold">Last Updated:</span>
                {{ $user->updated_at->diffForHumans() }}</p>
        </div>

        <!-- About -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                About Me</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $freelancerInfo->about_me ?? 'N/A' }}
            </p>
        </div>

        <!-- Skills -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                Skills
            </h2>
            <ul
                class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
                @if (!empty($freelancerInfo->skills))
                    @foreach (explode(',', $freelancerInfo->skills) as $skill)
                        <li>{{ trim($skill) }}</li>
                    @endforeach
                @else
                    <li>No skills added yet.</li>
                @endif
            </ul>
        </div>

        <!-- Experiences -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                Experiences
            </h2>
            @php
                $experiences = !empty($freelancerInfo->experiences)
                    ? $freelancerInfo->experiences
                    : [];
            @endphp

            @if (!empty($experiences))
                <ul class="space-y-4">
                    @foreach ($experiences as $exp)
                        <li class="border rounded-lg p-4 dark:border-gray-700">
                            <h3
                                class="font-semibold text-gray-800 dark:text-gray-100">
                                {{ $exp['job_title'] ?? 'N/A' }}
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-medium">Company:</span>
                                {{ $exp['company'] ?? 'N/A' }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-medium">Duration:</span>
                                {{ $exp['start_date'] ?? 'N/A' }} -
                                {{ $exp['end_date'] ?? 'Present' }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-medium">Description:</span>
                                {{ $exp['description'] ?? 'N/A' }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-700 dark:text-gray-300">N/A</p>
            @endif
        </div>

        <!-- Education -->
        <div class="mt-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 border-b pb-2 mb-4">
                Education
            </h2>
            @php
                $education = !empty($freelancerInfo->education)
                    ? $freelancerInfo->education
                    : [];
            @endphp

            @if (!empty($education))
                <ul class="space-y-4">
                    @foreach ($education as $edu)
                        <li class="border rounded-lg p-4 dark:border-gray-700">
                            <h3
                                class="font-semibold text-gray-800 dark:text-gray-100">
                                {{ $edu['degree'] ?? 'N/A' }}
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-medium">School:</span>
                                {{ $edu['school'] ?? 'N/A' }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-medium">Field of Study:</span>
                                {{ $edu['field_of_study'] ?? 'N/A' }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-medium">Years:</span>
                                {{ $edu['start_year'] ?? 'N/A' }} -
                                {{ $edu['end_year'] ?? 'Present' }}
                            </p>
                            @if (!empty($edu['awards']))
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-medium">Awards:</span>
                                    {{ $edu['awards'] }}
                                </p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-700 dark:text-gray-300">N/A</p>
            @endif
        </div>

        @if ($applicationInfo->status === 'pending')
            <div class="mt-6 flex gap-2 justify-center">
                <form
                    action="{{ route('client.jobs.applicant.accept', $applicationInfo) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <button class="btn btn-success flex-1">Accept
                        Applicant</button>
                </form>
            </div>
        @elseif($applicationInfo->status === 'accepted')
            <div class="mt-6 flex gap-2 justify-center">
                <button class="btn flex-1"
                    disabled="disabled">Accepted</button>
            </div>
        @elseif($applicationInfo->status === 'rejected')
            <div class="mt-6 flex gap-2 justify-center">
                <button class="btn btn-success flex-1">Accepted</button>
            </div>
        @endif
    </div>
</x-layouts.app>
