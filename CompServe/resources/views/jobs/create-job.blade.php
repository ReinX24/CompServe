<x-layouts.app>
    <!-- Enhanced Breadcrumbs -->
    <div class="breadcrumbs text-sm mb-6">
        <ul class="text-base-content/70">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="hover:text-primary transition-colors duration-200 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ $jobType === 'gig' ? route('client.gigs.index') : ($jobType === 'contract' ? route('client.contracts.index') : route('client.gigs.index')) }}"
                    class="hover:text-primary transition-colors duration-200">
                    {{ $jobType === 'gig' ? __('All Gigs') : ($jobType === 'contract' ? __('All Contracts') : __('All Jobs')) }}
                </a>
            </li>
            <li class="text-primary font-semibold">
                {{ $jobType === 'gig' ? 'Create Gig' : ($jobType === 'contract' ? 'Create Contract' : 'Create Job') }}
            </li>
        </ul>
    </div>

    <div class="max-w-4xl mx-auto">
        {{-- Hero Header --}}
        @include('jobs.partials.create-header')

        {{-- Main Form Card --}}
        <div class="relative">
            <!-- Glowing effect -->
            <div
                class="absolute -inset-0.5 bg-linear-to-r from-primary/5 to-secondary/5 rounded-2xl opacity-0 group-hover:opacity-100 transition duration-500 blur">
            </div>

            <div
                class="relative bg-base-100 rounded-2xl shadow-xl border-2 border-primary/20 overflow-hidden">
                <!-- Decorative top border -->
                <div
                    class="h-2 bg-linear-to-r from-primary via-secondary to-accent">
                </div>

                <div class="p-6 md:p-8">
                    {{-- Alpine.js Wrapper --}}
                    <div x-data="{
                        jobType: '{{ old('duration_type', $jobType ?? 'gig') }}',
                        durations: {
                            gig: ['1 day', '3 days', '5 days', '1 week', '1 month'],
                            contract: ['1 day', '3 days', '5 days', '1 week', '1 month', '3 months', '6 months', '1 year']
                        }
                    }">
                        @include('jobs.partials.create-form')
                    </div>
                </div>
            </div>
        </div>

        {{-- Helpful Tips Section --}}
        <div
            class="mt-8 bg-linear-to-br from-info/5 to-info/10 border border-info/30 rounded-2xl p-6 shadow-lg">
            <div class="flex items-start gap-4">
                <div class="bg-info/10 p-3 rounded-xl shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-info"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-base-content mb-2">💡
                        Tips for Better Results</h3>
                    <ul class="space-y-2 text-sm text-base-content/70">
                        <li class="flex items-start gap-2">
                            <span class="text-success font-bold">✓</span>
                            <span>Write a clear and detailed job description to
                                attract qualified freelancers</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-success font-bold">✓</span>
                            <span>Set realistic budgets and deadlines based on
                                project complexity</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-success font-bold">✓</span>
                            <span>List all required skills to help freelancers
                                understand your needs</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Styles --}}
    <style>
        /* Smooth transitions for all interactive elements */
        input:focus,
        textarea:focus,
        select:focus {
            transform: translateY(-1px);
        }

        /* Custom radio button styling */
        input[type="radio"]:checked+div {
            animation: pulse 0.3s ease-in-out;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }
    </style>
</x-layouts.app>
