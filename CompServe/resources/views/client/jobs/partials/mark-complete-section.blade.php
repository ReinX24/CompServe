<div class="mt-6 space-y-4">

    {{-- Mark Complete Button --}}
    <button class="btn btn-success btn-block"
        onclick="mark_complete_modal.showModal()">
        Mark Job as Complete
    </button>

    {{-- Cancel Job Button --}}
    <form action="{{ route('client.jobs.cancel', $jobListing) }}"
        method="POST">
        @csrf
        @method('PUT')
        <input type="hidden"
            name="freelancer_id"
            value="{{ $user->id }}">
        <button class="btn btn-error btn-block">Cancel Job</button>
    </form>

    {{-- Review Modal --}}
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
                    onclick="mark_complete_modal.close()">Close</button>
            </div>
        </form>
    </dialog>
</div>
