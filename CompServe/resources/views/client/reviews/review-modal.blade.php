<div x-show="showReviewModal"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div @click.away="showReviewModal = false"
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">

        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">
            Leave a Review
        </h2>

        <form action="{{ route('client.jobs.complete', $jobListing) }}"
            method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="rating"
                    class="block mb-2 font-medium">Rating</label>
                <select id="rating"
                    name="rating"
                    class="select select-bordered w-full">
                    <option value="5">⭐⭐⭐⭐⭐ Excellent
                    </option>
                    <option value="4">⭐⭐⭐⭐ Good
                    </option>
                    <option value="3">⭐⭐⭐ Average
                    </option>
                    <option value="2">⭐⭐ Poor</option>
                    <option value="1">⭐ Terrible
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="review"
                    class="block mb-2 font-medium">Comments
                    (optional)</label>
                <textarea id="review"
                    name="review"
                    class="textarea textarea-bordered w-full"
                    rows="3"
                    placeholder="Share your feedback..."></textarea>
            </div>

            <div>
                <input type="hidden"
                    name="user_id"
                    value="{{ $user->id }}">
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button"
                    class="btn btn-secondary"
                    @click="showReviewModal = false">
                    Cancel
                </button>

                <button type="submit"
                    class="btn btn-primary">
                    Submit Review & Complete
                </button>
            </div>
        </form>
    </div>
</div>
