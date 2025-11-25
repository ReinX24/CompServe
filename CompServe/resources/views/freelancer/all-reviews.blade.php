<x-layouts.app>
    <div class="max-w-5xl mx-auto mt-12 p-8 bg-base-100 rounded-3xl shadow-sm">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold mb-2 text-primary">
                ⭐ My Reviews ⭐</h1>
            <p class="text-gray-500 text-lg">See what clients say about your
                completed jobs</p>
            <div class="divider my-6"></div>
        </div>

        @if (!$reviews->isEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($reviews as $review)
                    <div
                        class="card bg-base-200 shadow-sm hover:shadow-md transition-all duration-300 rounded-2xl border border-base-300">
                        <div class="card-body space-y-2">
                            <!-- Job Title -->
                            <h2
                                class="card-title text-lg font-semibold text-primary">
                                📝
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
                                🗓 Reviewed on
                                {{ $review->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-8">
                {{ $reviews->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

</x-layouts.app>
