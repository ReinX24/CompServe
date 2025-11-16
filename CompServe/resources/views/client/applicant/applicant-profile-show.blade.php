<x-layouts.app>
    <div class="max-w-4xl mx-auto p-6">
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <!-- Header -->
                <div
                    class="flex flex-col md:flex-row items-center md:items-start gap-6 border-b border-base-300 pb-6">
                    <!-- Profile Avatar -->
                    <div class="avatar">
                        <div
                            class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <div
                                class="flex items-center justify-center w-full h-full bg-neutral text-neutral-content text-4xl font-bold">
                                {{ strtoupper(substr($user->name ?? Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                    </div>

                    <!-- Basic Info -->
                    <div>
                        <h1 class="text-3xl font-bold text-base-content">
                            {{ $user->name }}
                        </h1>
                        <p class="text-lg text-base-content/70 mt-1">
                            {{ ucfirst($user->role) }}
                        </p>
                        <p class="text-sm text-base-content/60 mt-1">
                            Member since {{ $user->created_at->format('F Y') }}
                        </p>
                    </div>
                </div>

                {{-- Average Rating --}}
                <div
                    class="flex flex-col items-center mb-10 border-b border-base-300 pb-6">
                    <p class="text-lg font-semibold mb-2 text-gray-700">
                        Average
                        Rating</p>

                    <div class="rating rating-lg">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio"
                                name="avg-rating"
                                class="mask mask-star-2 bg-yellow-400"
                                disabled
                                {{ $i <= round($averageRating) ? 'checked' : '' }} />
                        @endfor
                    </div>

                    <p class="mt-2 text-sm text-gray-500">
                        {{ number_format($averageRating, 1) }} / 5.0
                    </p>
                </div>

                <!-- Contact Info -->
                <div class="mt-6">
                    <h2
                        class="text-xl font-semibold text-base-content mb-4 border-b border-base-300 pb-2">
                        Contact</h2>
                    <div class="space-y-2">
                        <p><span class="font-semibold">Email:</span>
                            {{ $user->email }}</p>
                        <p><span class="font-semibold">Number:</span>
                            {{ $freelancerInfo->contact_number ?? 'N/A' }}</p>
                        <p><span class="font-semibold">Last Updated:</span>
                            {{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- About -->
                <div class="mt-6">
                    <h2
                        class="text-xl font-semibold text-base-content mb-4 border-b border-base-300 pb-2">
                        About Me</h2>
                    <p class="text-base-content/80">
                        {{ $freelancerInfo->about_me ?? 'No description available.' }}
                    </p>
                </div>

                <!-- Skills -->
                <div class="mt-6">
                    <h2
                        class="text-xl font-semibold text-base-content mb-4 border-b border-base-300 pb-2">
                        Skills</h2>
                    @if (!empty($freelancerInfo->skills))
                        <div class="flex flex-wrap gap-2">
                            @foreach (explode(',', $freelancerInfo->skills) as $skill)
                                <span
                                    class="badge badge-outline badge-primary">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-base-content/70">No skills added yet.</p>
                    @endif
                </div>

                <!-- Experiences -->
                <div class="mt-6">
                    <h2
                        class="text-xl font-semibold text-base-content mb-4 border-b border-base-300 pb-2">
                        Experiences</h2>
                    @php
                        $experiences = !empty($freelancerInfo->experiences)
                            ? $freelancerInfo->experiences
                            : [];
                    @endphp

                    @if (!empty($experiences))
                        <div class="grid gap-4">
                            @foreach ($experiences as $exp)
                                <div
                                    class="card bg-base-200 shadow-sm p-4 dark:bg-gray-700">
                                    <h3
                                        class="font-semibold text-base-content text-lg">
                                        {{ $exp['job_title'] ?? 'N/A' }}</h3>
                                    <p><span class="font-medium">Company:</span>
                                        {{ $exp['company'] ?? 'N/A' }}</p>
                                    <p><span
                                            class="font-medium">Duration:</span>
                                        {{ $exp['start_date'] ?? 'N/A' }} -
                                        {{ $exp['end_date'] ?? 'Present' }}</p>
                                    <p><span
                                            class="font-medium">Description:</span>
                                        {{ $exp['description'] ?? 'N/A' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-base-content/70">No experiences listed.
                        </p>
                    @endif
                </div>

                <!-- Education -->
                <div class="mt-6">
                    <h2
                        class="text-xl font-semibold text-base-content mb-4 border-b border-base-300 pb-2">
                        Education</h2>
                    @php
                        $education = !empty($freelancerInfo->education)
                            ? $freelancerInfo->education
                            : [];
                    @endphp

                    @if (!empty($education))
                        <div class="grid gap-4">
                            @foreach ($education as $edu)
                                <div
                                    class="card bg-base-200 shadow-sm p-4 dark:bg-gray-700">
                                    <h3
                                        class="font-semibold text-base-content text-lg">
                                        {{ $edu['degree'] ?? 'N/A' }}</h3>
                                    <p><span class="font-medium">School:</span>
                                        {{ $edu['school'] ?? 'N/A' }}</p>
                                    <p><span class="font-medium">Field of
                                            Study:</span>
                                        {{ $edu['field_of_study'] ?? 'N/A' }}
                                    </p>
                                    <p><span class="font-medium">Years:</span>
                                        {{ $edu['start_year'] ?? 'N/A' }} -
                                        {{ $edu['end_year'] ?? 'Present' }}</p>
                                    @if (!empty($edu['awards']))
                                        <p><span
                                                class="font-medium">Awards:</span>
                                            {{ $edu['awards'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-base-content/70">No education added yet.
                        </p>
                    @endif
                </div>

                <!-- Application Status Buttons -->
                <div class="mt-8 flex justify-center">
                    @if ($applicationInfo->status === 'pending')
                        <form
                            action="{{ route('client.jobs.applicant.accept', $applicationInfo) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <button
                                class="btn btn-success w-full md:w-48">Accept
                                Applicant</button>
                        </form>
                    @elseif($applicationInfo->status === 'accepted')
                        <button
                            class="btn btn-success w-full md:w-48 btn-active"
                            disabled>Accepted</button>
                    @elseif($applicationInfo->status === 'completed')
                        <button class="btn btn-accent w-full md:w-48 btn-active"
                            disabled>Completed</button>
                    @elseif($applicationInfo->status === 'rejected')
                        <button class="btn btn-error w-full md:w-48 btn-active"
                            disabled>Rejected</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
