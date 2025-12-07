<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">All Reviews</li>
        </ul>
    </div>

    <x-client.page-header-with-action title="⭐ Reviews"
        description="All your reviews from completed jobs." />

    <!-- Search + Filters -->
    <form method="GET"
        action="{{ route('client.reviews') }}"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 bg-base-100 p-4 rounded-lg shadow-sm border border-base-300 mb-6">
        <!-- Search -->
        <div class="lg:col-span-2">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text font-semibold">Search</span>
                </div>
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search job title, freelancer..."
                    class="input input-bordered w-full" />
            </label>
        </div>

        <!-- Min Rating -->
        <div>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text font-semibold">Min Rating</span>
                </div>
                <select name="min_rating"
                    class="select select-bordered w-full">
                    <option value="">Any</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}"
                            {{ request('min_rating') == $i ? 'selected' : '' }}>
                            {{ $i }} ★+
                        </option>
                    @endfor
                </select>
            </label>
        </div>

        <!-- Exact Rating -->
        <div>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text font-semibold">Exact Rating</span>
                </div>
                <select name="rating"
                    class="select select-bordered w-full">
                    <option value="">Any</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}"
                            {{ request('rating') == $i ? 'selected' : '' }}>
                            {{ $i }} ★
                        </option>
                    @endfor
                </select>
            </label>
        </div>

        <!-- Buttons -->
        <div class="lg:col-span-2 flex items-end gap-2">
            <button type="submit"
                class="btn btn-primary flex-1">
                Search
            </button>
            <a href="{{ route('client.reviews') }}"
                class="btn btn-outline flex-1">
                Reset
            </a>
        </div>
    </form>

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
                <x-client.review-card :avatar="$review->freelancer->profile_photo ?? null"
                    :name="$review->client->name ?? 'Unknown'"
                    role="Client"
                    :rating="$review->rating"
                    :review="$review->comments ?? 'No comments provided.'"
                    :date="$review->created_at" />
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    @endif
</x-layouts.app>
