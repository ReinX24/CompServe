<x-layouts.app>
    <div class="container mx-auto px-4 md:px-6 py-6">
        <!-- Page Header -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h1 class="text-3xl font-bold text-primary">⭐ All Reviews</h1>
            {{-- Optional: Add button to add a review if needed --}}
            {{-- <a href="{{ route('reviews.create') }}" class="btn btn-primary w-full md:w-auto">➕ Add Review</a> --}}
        </div>

        <!-- Alerts -->
        @session('success')
            <div class="mb-4">
                <div role="alert"
                    class="alert alert-success alert-soft text-lg shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endsession

        <!-- Reviews Table -->
        <div class="overflow-x-auto">
            <table class="table w-full rounded-lg shadow-sm">
                <thead class="bg-base-200">
                    <tr>
                        <th>#</th>
                        <th>Reviewer</th>
                        <th>Freelancer</th>
                        <th>Rating</th>
                        <th class="hidden md:table-cell">Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr class="hover:bg-base-100 transition-colors">
                            <td>{{ $review->id }}</td>
                            <td class="whitespace-normal font-semibold">
                                {{ $review->client->name ?? 'N/A' }}</td>
                            <td class="whitespace-normal font-semibold">
                                {{ $review->freelancer->name ?? 'N/A' }}</td>
                            <td>
                                <div class="rating rating-sm">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio"
                                            name="rating-{{ $review->id }}"
                                            class="mask mask-star-2 bg-yellow-400"
                                            @if ($i == $review->rating) checked @endif
                                            disabled />
                                    @endfor
                                </div>
                            </td>
                            <td class="whitespace-normal hidden md:table-cell">
                                {{ $review->comment }}</td>
                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    </div>
</x-layouts.app>
