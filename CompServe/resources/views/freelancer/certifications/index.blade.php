<x-layouts.app>
    <!-- Breadcrumbs with Enhanced Styling -->
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
            <li class="text-primary font-semibold">My Certifications</li>
        </ul>
    </div>

    <!-- Hero Header with Gradient Background -->
    <div
        class="relative overflow-hidden bg-linear-to-br from-primary/10 via-secondary/5 to-accent/10 rounded-2xl shadow-xl mb-8 border border-base-300/50">
        <!-- Decorative Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div
                class="absolute top-0 left-0 w-40 h-40 bg-primary rounded-full blur-3xl">
            </div>
            <div
                class="absolute bottom-0 right-0 w-60 h-60 bg-secondary rounded-full blur-3xl">
            </div>
        </div>

        <div class="relative p-8 md:p-10">
            <div
                class="flex flex-col md:flex-row md:justify-between md:items-center gap-6">
                <div class="flex-1">
                    <h1
                        class="text-4xl md:text-5xl font-bold text-base-content mb-3 flex items-center gap-3">
                        <span class="text-5xl">🎓</span>
                        My Certifications
                    </h1>
                    <p
                        class="text-base md:text-lg text-base-content/70 max-w-2xl">
                        Showcase your verified skills and qualifications to
                        stand out from the crowd ✨
                    </p>

                    <!-- Stats -->
                    <div class="flex flex-wrap gap-6 mt-6">
                        <div class="flex items-center gap-2">
                            <div
                                class="bg-success/20 text-success p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-base-content">
                                    {{ $certifications->where('status', 'approved')->count() }}
                                </p>
                                <p class="text-xs text-base-content/60">Approved
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div
                                class="bg-warning/20 text-warning p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-base-content">
                                    {{ $certifications->where('status', 'pending')->count() }}
                                </p>
                                <p class="text-xs text-base-content/60">Pending
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div
                                class="bg-primary/20 text-primary p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-base-content">
                                    {{ $certifications->count() }}</p>
                                <p class="text-xs text-base-content/60">Total
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shrink-0">
                    <a href="{{ route('freelancer.certifications.create') }}"
                        class="btn btn-primary btn-lg shadow-2xl hover:shadow-primary/50 hover:scale-105 transition-all duration-300 gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 group-hover:rotate-90 transition-transform duration-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Submit Certification
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Message with Enhanced Styling --}}
    @session('success')
        <div class="mb-6 animate-fade-in">
            <div role="alert"
                class="alert bg-success/10 border-success/30 text-success shadow-lg rounded-xl flex items-center gap-3 p-4">
                <div class="bg-success/20 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endsession

    <!-- Certifications Grid with Staggered Animation -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($certifications as $index => $cert)
            <div style="animation-delay: {{ $index * 50 }}ms"
                class="animate-fade-in-up">
                <x-freelancer.cert-card :cert="$cert" />
            </div>
        @empty
            <div class="col-span-full">
                <div
                    class="relative overflow-hidden bg-linear-to-br from-info/5 to-info/10 border-2 border-dashed border-info/30 shadow-lg rounded-2xl p-12 text-center">
                    <!-- Decorative Elements -->
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-info/5 rounded-full blur-3xl">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-40 h-40 bg-info/5 rounded-full blur-3xl">
                    </div>

                    <div class="relative">
                        <div
                            class="inline-flex items-center justify-center w-20 h-20 bg-info/10 rounded-full mb-6">
                            <span class="text-5xl">📭</span>
                        </div>
                        <h3 class="text-2xl font-bold text-base-content mb-2">No
                            Certifications Yet</h3>
                        <p class="text-base-content/60 mb-6 max-w-md mx-auto">
                            Start building your professional credentials by
                            applying for your first certification.
                        </p>
                        <a href="{{ route('freelancer.certifications.create') }}"
                            class="btn btn-primary gap-2 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Submit your first Certification
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Add Custom Animations -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
            opacity: 0;
        }
    </style>
</x-layouts.app>
