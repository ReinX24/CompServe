<x-layouts.app>
    <div class="max-w-5xl mx-auto mt-12 p-8 bg-base-100 rounded-2xl shadow-2xl">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold mb-2 text-primary">My Reviews</h1>
            <p class="text-gray-500">See what clients say about your completed
                jobs</p>
            <div class="divider my-6"></div>
        </div>

        @if ($reviews->isEmpty())
            <div class="alert alert-info shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="stroke-current shrink-0 h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 6a9 9 0 110 18 9 9 0 010-18z" />
                    </svg>
                    <span>No reviews yet. Complete jobs to start receiving
                        feedback!</span>
                </div>
            </div>
        @else
            <!-- Average Rating -->
            <div class="flex flex-col items-center mb-10">
                <p class="text-lg font-semibold mb-2 text-gray-700">Average
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

                <div class="divider mt-6 mb-2"></div>
            </div>

            <!-- Review List -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($reviews as $review)
                    <div
                        class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                        <div class="card-body">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3
                                        class="card-title text-lg font-semibold text-primary">
                                        {{ $review->jobListing->title ?? 'Untitled Job' }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $review->comments }}
                                    </p>
                                </div>

                                <div class="rating rating-sm">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio"
                                            class="mask mask-star-2 bg-yellow-400"
                                            disabled
                                            {{ $i == $review->rating ? 'checked' : '' }} />
                                    @endfor
                                </div>
                            </div>

                            <p class="mt-4 text-gray-700 leading-relaxed">
                                {{ $review->comment }}
                            </p>

                            <div class="card-actions justify-end mt-4">
                                <div class="badge badge-outline badge-primary">
                                    ★ {{ $review->rating }} / 5
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
