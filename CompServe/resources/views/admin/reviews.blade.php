<x-layouts.app>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">All Reviews</h1>

        <div class="overflow-x-auto bg-base-100 shadow-md rounded-lg">
            <table class="table w-full">
                <thead class="bg-base-200">
                    <tr>
                        <th>#</th>
                        <th>Reviewer</th>
                        <th>Freelancer</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr class="hover">
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->client->name ?? 'N/A' }}</td>
                            <td>{{ $review->freelancer->name ?? 'N/A' }}</td>
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
                            <td>{{ $review->comment }}</td>
                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    </div>
</x-layouts.app>
