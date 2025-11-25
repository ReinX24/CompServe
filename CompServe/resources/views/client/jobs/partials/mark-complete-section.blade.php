<div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">

    {{-- Mark Complete Button --}}
    <button class="btn btn-success btn-sm md:btn-md w-full md:w-auto"
        onclick="document.getElementById('mark_complete_modal').showModal()">
        Mark as Complete
    </button>

    {{-- Cancel Job Button (triggers modal) --}}
    <button class="btn btn-error btn-sm md:btn-md w-full md:w-auto"
        onclick="document.getElementById('cancel_job_modal').showModal()">
        Cancel Job
    </button>

    {{-- Mark Complete Modal --}}
    <dialog id="mark_complete_modal"
        class="modal">
        <form method="POST"
            action="{{ route('client.jobs.complete', $jobListing) }}"
            class="modal-box space-y-4">
            @csrf
            @method('PUT')

            <h3 class="font-bold text-lg">Submit Review & Complete Job</h3>

            <textarea name="review"
                class="textarea textarea-bordered w-full"
                placeholder="Write your review here..."></textarea>

            <div class="rating rating-lg flex justify-center">
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

            <input type="hidden"
                name="freelancer_id"
                value="{{ $user->id }}">

            <div class="modal-action">
                <button class="btn btn-primary">Submit</button>
                <button type="button"
                    class="btn"
                    onclick="document.getElementById('mark_complete_modal').close()">Close</button>
            </div>
        </form>
    </dialog>

    {{-- Cancel Job Confirmation Modal --}}
    <dialog id="cancel_job_modal"
        class="modal">
        <form method="POST"
            action="{{ route('client.jobs.cancel', $jobListing) }}"
            class="modal-box">
            @csrf
            @method('PUT')
            <input type="hidden"
                name="freelancer_id"
                value="{{ $user->id }}">

            <h3 class="font-bold text-lg">Cancel Job?</h3>
            <p class="py-4">Are you sure you want to <strong>cancel this
                    job</strong> for this applicant?</p>

            <div class="modal-action">
                <button class="btn btn-error">Yes, Cancel Job</button>
                <button type="button"
                    class="btn"
                    onclick="document.getElementById('cancel_job_modal').close()">Close</button>
            </div>
        </form>
    </dialog>

</div>
