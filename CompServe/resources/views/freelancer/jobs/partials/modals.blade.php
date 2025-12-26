{{-- Apply Confirmation Modal --}}
<dialog id="apply_modal"
    class="modal modal-bottom sm:modal-middle">
    <form method="POST"
        id="applyForm"
        class="modal-box">
        @csrf
        <input type="hidden"
            name="jobId"
            id="applyJobId">
        <h3 class="font-bold text-2xl mb-4">Apply for this Job?</h3>
        <div class="alert alert-info mb-4">
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
            <span>You are about to submit your application for this job. The
                client will review your profile and get back to you.</span>
        </div>
        <div class="modal-action">
            <button type="button"
                class="btn btn-ghost"
                onclick="closeApplyModal()">Cancel</button>
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
                Confirm Application
            </button>
        </div>
    </form>
    <form method="dialog"
        class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

{{-- Remove / Cancel Confirmation Modal --}}
<dialog id="remove_modal"
    class="modal modal-bottom sm:modal-middle">
    <form method="POST"
        id="removeForm"
        class="modal-box">
        @csrf
        @method('DELETE')
        <h3 class="font-bold text-2xl mb-4">Remove Application?</h3>
        <div class="alert alert-warning mb-4">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="stroke-current shrink-0 h-6 w-6"
                fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>This action will remove/cancel your application. This
                cannot be undone.</span>
        </div>
        <div class="modal-action">
            <button type="button"
                class="btn btn-ghost"
                onclick="closeRemoveModal()">Cancel</button>
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
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Yes, Remove
            </button>
        </div>
    </form>
    <form method="dialog"
        class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
