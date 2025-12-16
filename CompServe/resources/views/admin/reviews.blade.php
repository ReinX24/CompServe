<x-layouts.app>
    <div
        class="min-h-screen bg-linear-to-br from-base-200 via-base-100 to-base-200 py-8 px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Page Header -->
            <div class="mb-8">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-warning/10 p-3 rounded-xl">
                            ⭐
                        </div>
                        <div>
                            <h1
                                class="text-4xl font-bold bg-linear-to-r from-warning to-secondary bg-clip-text text-transparent">
                                Reviews & Ratings
                            </h1>
                            <p class="text-base-content/70 text-sm mt-1">
                                Monitor all freelancer reviews and feedback
                            </p>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div
                        class="stats shadow-lg bg-base-100 border-2 border-base-300">
                        <div class="stat py-3 px-4">
                            <div class="stat-title text-xs">Total Reviews</div>
                            <div class="stat-value text-2xl text-primary">
                                {{ $reviews->total() }}
                            </div>
                        </div>
                        <div class="stat py-3 px-4">
                            <div class="stat-title text-xs">Avg Rating</div>
                            <div class="stat-value text-2xl text-warning">
                                {{ number_format($reviews->avg('rating') ?? 0, 1) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div
                    class="alert alert-success mb-6 shadow-lg border-2 border-success/20">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Reviews Table Card -->
            <div class="card bg-base-100 shadow-xl border-2 border-base-300">
                <div class="card-body p-0">

                    <!-- Desktop Table -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="table table-zebra">
                            <thead class="bg-base-200">
                                <tr>
                                    <th>#</th>
                                    <th>Reviewer</th>
                                    <th>Freelancer</th>
                                    <th class="text-center">Rating</th>
                                    <th>Comment</th>
                                    <th class="text-center">Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($reviews as $review)
                                    <tr
                                        class="hover:bg-base-200/50 transition-colors">
                                        <td class="font-mono text-sm">
                                            <span
                                                class="badge badge-ghost badge-sm">
                                                {{ $review->id }}
                                            </span>
                                        </td>

                                        <!-- Reviewer -->
                                        <td>
                                            <div
                                                class="flex items-center gap-3">
                                                <div
                                                    class="avatar avatar-placeholder">
                                                    <div
                                                        class="bg-primary text-primary-content rounded-full w-10">
                                                        <span class="font-bold">
                                                            {{ substr($review->client->name ?? 'N', 0, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-semibold">
                                                        {{ $review->client->name ?? 'N/A' }}
                                                    </div>
                                                    <div
                                                        class="text-xs text-base-content/60">
                                                        Client
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Freelancer -->
                                        <td>
                                            <div
                                                class="flex items-center gap-3">
                                                <div
                                                    class="avatar avatar-placeholder">
                                                    <div
                                                        class="bg-secondary text-secondary-content rounded-full w-10">
                                                        <span class="font-bold">
                                                            {{ substr($review->freelancer->name ?? 'F', 0, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-semibold">
                                                        {{ $review->freelancer->name ?? 'N/A' }}
                                                    </div>
                                                    <div
                                                        class="text-xs text-base-content/60">
                                                        Freelancer
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Rating -->
                                        <td class="text-center">
                                            <div
                                                class="flex flex-col items-center gap-1">
                                                <div class="rating rating-sm">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <input type="radio"
                                                            class="mask mask-star-2 {{ $i <= $review->rating ? 'bg-warning' : 'bg-base-300' }}"
                                                            disabled />
                                                    @endfor
                                                </div>
                                                <span
                                                    class="badge badge-warning badge-sm">
                                                    {{ $review->rating }}/5
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Comment -->
                                        <td class="max-w-md">
                                            <p
                                                class="text-sm text-base-content/80 line-clamp-2">
                                                {{ $review->comment ?: 'No comment provided' }}
                                            </p>

                                            @if ($review->comment && strlen($review->comment) > 100)
                                                <button
                                                    onclick="document.getElementById('commentModal-{{ $review->id }}').showModal()"
                                                    class="text-xs text-primary hover:underline mt-1">
                                                    Read more
                                                </button>
                                            @endif
                                        </td>

                                        <!-- Date -->
                                        <td class="text-center text-sm">
                                            <div class="font-semibold">
                                                {{ $review->created_at->format('M d, Y') }}
                                            </div>
                                            <div
                                                class="text-xs text-base-content/60">
                                                {{ $review->created_at->diffForHumans() }}
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Comment Modal -->
                                    @if ($review->comment)
                                        <dialog
                                            id="commentModal-{{ $review->id }}"
                                            class="modal modal-bottom sm:modal-middle">
                                            <div class="modal-box">
                                                <h3
                                                    class="font-bold text-2xl mb-4 flex items-center gap-2">
                                                    💬 Full Review
                                                </h3>

                                                <div class="space-y-4">
                                                    <div
                                                        class="flex items-center gap-3 p-4 bg-base-200 rounded-lg">
                                                        <div
                                                            class="avatar avatar-placeholder">
                                                            <div
                                                                class="bg-primary text-primary-content rounded-full w-12">
                                                                <span
                                                                    class="text-xl">
                                                                    {{ substr($review->client->name ?? 'N', 0, 1) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div
                                                                class="font-bold">
                                                                {{ $review->client->name ?? 'N/A' }}
                                                            </div>
                                                            <div
                                                                class="text-sm text-base-content/60">
                                                                reviewed
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="rating rating-sm">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <input
                                                                    type="radio"
                                                                    class="mask mask-star-2 {{ $i <= $review->rating ? 'bg-warning' : 'bg-base-300' }}"
                                                                    disabled />
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="p-4 bg-base-100 rounded-lg border border-base-300">
                                                        <p
                                                            class="whitespace-pre-wrap">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>

                                                    <div
                                                        class="text-sm text-base-content/60 text-right">
                                                        {{ $review->created_at->format('F j, Y \a\t g:i A') }}
                                                    </div>
                                                </div>

                                                <div class="modal-action">
                                                    <button
                                                        class="btn btn-primary"
                                                        onclick="document.getElementById('commentModal-{{ $review->id }}').close()">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                            <form method="dialog"
                                                class="modal-backdrop">
                                                <button>close</button>
                                            </form>
                                        </dialog>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="text-center py-12 text-base-content/60">
                                            No reviews yet
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="lg:hidden p-4 space-y-4">
                        @foreach ($reviews as $review)
                            <div
                                class="card bg-base-200 border-2 border-base-300 shadow-lg">
                                <div class="card-body p-4 space-y-2">
                                    <div class="font-bold">
                                        {{ $review->freelancer->name ?? 'N/A' }}
                                    </div>

                                    <div class="rating rating-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="radio"
                                                class="mask mask-star-2 {{ $i <= $review->rating ? 'bg-warning' : 'bg-base-300' }}"
                                                disabled />
                                        @endfor
                                    </div>

                                    <p class="text-sm line-clamp-3">
                                        {{ $review->comment ?: 'No comment provided' }}
                                    </p>

                                    <div class="text-xs text-base-content/60">
                                        {{ $review->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <!-- Pagination -->
            @if ($reviews->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $reviews->links() }}
                </div>
            @endif

        </div>
    </div>
</x-layouts.app>
