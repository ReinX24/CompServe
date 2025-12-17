<div class="flex flex-col sm:flex-row gap-3 w-full">

    {{-- Mark Complete Button --}}
    <button class="btn btn-success btn-md gap-2 flex-1"
        onclick="document.getElementById('mark_complete_modal').showModal()">
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Mark as Complete
    </button>

    {{-- Cancel Job Button --}}
    <button class="btn btn-error btn-md gap-2 flex-1"
        onclick="document.getElementById('cancel_job_modal').showModal()">
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
        Cancel Job
    </button>

</div>

{{-- Mark Complete Modal --}}
<dialog id="mark_complete_modal"
    class="modal modal-bottom sm:modal-middle">
    <form method="POST"
        action="{{ route('client.jobs.complete', $jobListing) }}"
        enctype="multipart/form-data"
        class="modal-box max-w-2xl">
        @csrf
        @method('PUT')

        <h3 class="font-bold text-2xl mb-4">Complete Job & Submit Review</h3>

        <div class="alert alert-info mb-6">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                class="stroke-current shrink-0 w-6 h-6">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
            <span>Mark this job as complete and provide feedback for the
                freelancer.</span>
        </div>

        {{-- Review Section --}}
        <div class="space-y-4">
            <div class="form-control">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend font-semibold">Your Review
                        Comments</legend>
                    <textarea name="comments"
                        class="textarea textarea-bordered h-24"
                        placeholder="Share your experience working with this freelancer..."></textarea>
                </fieldset>
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Rating
                        (Required)</span>
                </label>
                <div class="flex justify-center p-4 bg-base-200 rounded-lg">
                    <div class="rating rating-lg gap-2">
                        <input type="radio"
                            name="rating"
                            value="1"
                            class="mask mask-star-2 bg-yellow-400"
                            required />
                        <input type="radio"
                            name="rating"
                            value="2"
                            class="mask mask-star-2 bg-yellow-400" />
                        <input type="radio"
                            name="rating"
                            value="3"
                            class="mask mask-star-2 bg-yellow-400" />
                        <input type="radio"
                            name="rating"
                            value="4"
                            class="mask mask-star-2 bg-yellow-400" />
                        <input type="radio"
                            name="rating"
                            value="5"
                            class="mask mask-star-2 bg-yellow-400" />
                    </div>
                </div>
            </div>

            <div class="divider">Payment Information</div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Payment Amount
                        (Required)</span>
                </label>
                <label class="input-group">
                    <span class="bg-primary text-primary-content">₱</span>
                    <input type="number"
                        name="price"
                        step="0.01"
                        min="0"
                        class="input input-bordered w-full"
                        placeholder="0.00"
                        required />
                </label>
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Upload Proof of
                        Payment (Required)</span>
                    <span class="label-text-alt">Image or PDF</span>
                </label>
                <input type="file"
                    name="proof_of_payment"
                    accept="image/*,.pdf"
                    class="file-input file-input-bordered w-full"
                    required />
            </div>

            <input type="hidden"
                name="freelancer_id"
                value="{{ $user->id }}">
        </div>

        <div class="modal-action">
            <button type="button"
                class="btn btn-ghost"
                onclick="document.getElementById('mark_complete_modal').close()">Cancel</button>
            <button type="submit"
                class="btn btn-primary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7" />
                </svg>
                Submit & Complete
            </button>
        </div>
    </form>
    <form method="dialog"
        class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

{{-- Cancel Job Modal --}}
<dialog id="cancel_job_modal"
    class="modal modal-bottom sm:modal-middle">
    <form method="POST"
        action="{{ route('client.jobs.cancel', $jobListing) }}"
        class="modal-box max-w-2xl">
        @csrf
        @method('PUT')
        <input type="hidden"
            name="freelancer_id"
            value="{{ $user->id }}">

        <h3 class="font-bold text-2xl mb-4">Cancel This Job?</h3>

        <div class="alert alert-warning mb-6">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="stroke-current shrink-0 h-6 w-6"
                fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>You are about to cancel this job. This action cannot be
                undone.</span>
        </div>

        {{-- Optional Review Section --}}
        <div class="space-y-4">
            <div class="divider">Leave a Review (Optional)</div>

            <fieldset class="fieldset">
                <legend class="fieldset-legend font-semibold">Your Review
                    Comments</legend>
                <textarea name="comments"
                    class="textarea textarea-bordered h-24"
                    placeholder="Share your experience working with this freelancer..."></textarea>
                <div class="label">Optional</div>
            </fieldset>

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Rating</span>
                    <span class="label-text-alt">Optional</span>
                </label>
                <div class="flex justify-center p-4 bg-base-200 rounded-lg">
                    <div class="rating rating-lg gap-2">
                        <input type="radio"
                            name="rating"
                            value="1"
                            class="mask mask-star-2 bg-yellow-400" />
                        <input type="radio"
                            name="rating"
                            value="2"
                            class="mask mask-star-2 bg-yellow-400" />
                        <input type="radio"
                            name="rating"
                            value="3"
                            class="mask mask-star-2 bg-yellow-400" />
                        <input type="radio"
                            name="rating"
                            value="4"
                            class="mask mask-star-2 bg-yellow-400" />
                        <input type="radio"
                            name="rating"
                            value="5"
                            class="mask mask-star-2 bg-yellow-400" />
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-action">
            <button type="button"
                class="btn btn-ghost"
                onclick="document.getElementById('cancel_job_modal').close()">Close</button>
            <button type="submit"
                class="btn btn-error gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
                Yes, Cancel Job
            </button>
        </div>
    </form>
    <form method="dialog"
        class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
