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
            <li class="text-primary font-semibold">My Reviews</li>
        </ul>
    </div>

    <!-- Hero Header with Gradient Background -->
    <div
        class="relative overflow-hidden bg-linear-to-br from-warning/10 via-secondary/5 to-accent/10 rounded-2xl shadow-xl mb-8 border border-base-300/50">
        <!-- Decorative Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div
                class="absolute top-0 left-0 w-40 h-40 bg-warning rounded-full blur-3xl">
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
                        <span class="text-5xl">⭐</span>
                        My Reviews
                    </h1>
                    <p
                        class="text-base md:text-lg text-base-content/70 max-w-2xl">
                        See what clients say about your completed jobs and build
                        your reputation ✨
                    </p>

                    <!-- Stats -->
                    @php
                        $totalReviews = $reviews->total();
                        $averageRating = $reviews->avg('rating');
                        $fiveStarReviews = $reviews
                            ->where('rating', 5)
                            ->count();
                    @endphp
                    <div class="flex flex-wrap gap-6 mt-6">
                        <div class="flex items-center gap-2">
                            <div
                                class="bg-warning/20 text-warning p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-base-content">
                                    {{ number_format($averageRating, 1) }}
                                </p>
                                <p class="text-xs text-base-content/60">Average
                                    Rating</p>
                            </div>
                        </div>
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
                                    {{ $fiveStarReviews }}</p>
                                <p class="text-xs text-base-content/60">5-Star
                                    Reviews</p>
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
                                    {{ $totalReviews }}</p>
                                <p class="text-xs text-base-content/60">Total
                                    Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Distribution Visual (Optional) -->
                <div
                    class="shrink-0 bg-base-100/80 backdrop-blur-sm rounded-xl p-6 shadow-lg">
                    <div class="text-center">
                        <div class="text-5xl font-bold text-warning mb-2">
                            {{ number_format($averageRating, 1) }}</div>
                        <div class="rating rating-sm mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio"
                                    class="mask mask-star-2 bg-warning"
                                    disabled
                                    {{ $i <= round($averageRating) ? 'checked' : '' }} />
                            @endfor
                        </div>
                        <p class="text-xs text-base-content/60">Based on
                            {{ $totalReviews }} reviews</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Grid with Staggered Animation -->
    @if (!$reviews->isEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
            @foreach ($reviews as $index => $review)
                <div style="animation-delay: {{ $index * 50 }}ms"
                    class="animate-fade-in-up">
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 border border-base-300 hover:border-warning/50 h-full">
                        <div class="card-body">
                            <!-- Rating Stars - Prominent -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                                class="w-6 h-6 text-warning">
                                                <path
                                                    d="M12 .587l3.668 7.568L24 9.753l-6 5.847L19.335 24 12 19.897 4.665 24 6 15.6 0 9.753l8.332-1.598z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-6 h-6 text-base-300">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.317 4.695 5.178.753a.562.562 0 0 1 .311.958l-3.748 3.652.885 5.163a.562.562 0 0 1-.815.592L12 17.769l-4.636 2.443a.562.562 0 0 1-.815-.592l.885-5.163-3.748-3.652a.562.562 0 0 1 .311-.958l5.178-.753 2.317-4.695Z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <div
                                    class="badge badge-warning badge-lg font-bold">
                                    {{ $review->rating }}/5</div>
                            </div>

                            <!-- Job Title with Icon -->
                            <h2
                                class="card-title text-xl mb-3 flex items-start gap-2">
                                <span class="text-2xl shrink-0">📝</span>
                                <span
                                    class="line-clamp-2">{{ $review->jobListing->title ?? 'Job Title Unavailable' }}</span>
                            </h2>

                            <!-- Client Info with Avatar -->
                            <div
                                class="flex items-center gap-3 mb-4 p-3 bg-base-200 rounded-lg">
                                <div class="avatar avatar-placeholder">
                                    <div
                                        class="bg-secondary text-secondary-content rounded-full w-10">
                                        <span
                                            class="text-sm">{{ substr($review->client->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-base-content/60">
                                        Reviewed by</p>
                                    <p class="font-semibold truncate">
                                        {{ $review->client->name ?? 'Unknown' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Review Comments -->
                            <div class="bg-base-200 rounded-lg p-4 mb-4">
                                <p class="text-base-content/80 leading-relaxed">
                                    {{ $review->comments ?? 'No comments provided.' }}
                                </p>
                            </div>

                            <!-- Footer with Date -->
                            <div
                                class="flex items-center justify-between text-xs text-base-content/60 pt-2 border-t border-base-300">
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $review->created_at->format('M d, Y') }}
                                </div>
                                <span
                                    class="badge badge-ghost badge-sm">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Enhanced Pagination -->
        <div class="flex justify-center">
            {{ $reviews->links('pagination::tailwind') }}
        </div>
    @else
        <!-- Empty State -->
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
                        <span class="text-5xl">⭐</span>
                    </div>
                    <h3 class="text-2xl font-bold text-base-content mb-2">No
                        Reviews Yet</h3>
                    <p class="text-base-content/60 mb-6 max-w-md mx-auto">
                        Complete your first job to receive reviews from clients
                        and build your reputation.
                    </p>
                    <a href="{{ route('freelancer.gigs.index') }}"
                        class="btn btn-primary gap-2 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                clip-rule="evenodd" />
                        </svg>
                        Browse Available Jobs
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Add Custom Animations -->
    <style>
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

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
            opacity: 0;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-layouts.app>
