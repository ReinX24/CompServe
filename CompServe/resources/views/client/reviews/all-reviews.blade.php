<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">All Reviews</li>
        </ul>
    </div>

    <x-client.page-header-with-action title="Reviews"
        description="All your reviews from completed jobs." />

    @if ($reviews->isEmpty())
        <div class="alert alert-info shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6 shrink-0">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2z" />
            </svg>
            <span>No reviews yet.</span>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($reviews as $review)
                <div class="card bg-base-100 shadow-sm border border-base-300">
                    <div class="card-body space-y-2">
                        <!-- Job Title -->
                        <h2
                            class="card-title text-lg font-semibold text-base-content">
                            {{ $review->jobListing->title ?? 'Job Title Unavailable' }}
                        </h2>

                        <!-- Freelancer Info -->
                        <p class="text-sm text-base-content/70">
                            <span class="font-semibold">Freelancer:</span>
                            {{ $review->freelancer->name ?? 'Unknown' }}
                        </p>

                        <!-- Client Info -->
                        <p class="text-sm text-base-content/70">
                            <span class="font-semibold">Reviewed by:</span>
                            {{ $review->client->name ?? 'Unknown' }}
                        </p>

                        <!-- Rating -->
                        <div class="flex items-center mt-1 space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                        class="w-5 h-5 text-yellow-400">
                                        <path
                                            d="M12 .587l3.668 7.568L24 9.753l-6 5.847L19.335 24 12 19.897 4.665 24 6 15.6 0 9.753l8.332-1.598z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-5 h-5 text-gray-400">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.317 4.695 5.178.753a.562.562 0 0 1 .311.958l-3.748 3.652.885 5.163a.562.562 0 0 1-.815.592L12 17.769l-4.636 2.443a.562.562 0 0 1-.815-.592l.885-5.163-3.748-3.652a.562.562 0 0 1 .311-.958l5.178-.753 2.317-4.695Z" />
                                    </svg>
                                @endif
                            @endfor
                        </div>

                        <!-- Review Comments -->
                        <p class="text-base-content/80 mt-2">
                            <span class="font-semibold">Comments:</span>
                            {{ $review->comments ?? 'No comments provided.' }}
                        </p>

                        <!-- Review Date -->
                        <p class="text-xs text-base-content/60 mt-1">
                            Reviewed on
                            {{ $review->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    @endif
</x-layouts.app>
