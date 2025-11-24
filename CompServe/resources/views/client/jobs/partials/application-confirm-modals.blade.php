{{-- Accept Confirmation Modal --}}
<dialog id="accept_modal"
    class="modal">
    <form method="POST"
        id="acceptForm"
        class="modal-box">
        @csrf
        @method('PUT')

        <h3 class="font-bold text-lg">Accept Applicant?</h3>
        <p class="py-4">Are you sure you want to <strong>accept</strong> this
            applicant?</p>

        <div class="modal-action">
            <button class="btn btn-success">Yes, Accept</button>
            <button type="button"
                class="btn"
                onclick="closeAcceptModal()">Cancel</button>
        </div>
    </form>
</dialog>

{{-- Reject Confirmation Modal --}}
<dialog id="reject_modal"
    class="modal">
    <form method="POST"
        id="rejectForm"
        class="modal-box">
        @csrf
        @method('PUT')

        <h3 class="font-bold text-lg">Reject Applicant?</h3>
        <p class="py-4">Are you sure you want to <strong>reject</strong> this
            applicant?</p>

        <div class="modal-action">
            <button class="btn btn-error">Yes, Reject</button>
            <button type="button"
                class="btn"
                onclick="closeRejectModal()">Cancel</button>
        </div>
    </form>
</dialog>

<script>
    function openAcceptModal(applicationId) {
        const form = document.getElementById('acceptForm');
        form.action = `/client/jobs/${applicationId}/accept`;

        const modal = document.getElementById('accept_modal');
        modal.showModal();
    }

    function openRejectModal(applicationId) {
        const form = document.getElementById('rejectForm');
        form.action = `/client/jobs/${applicationId}/reject`;

        const modal = document.getElementById('reject_modal');
        modal.showModal();
    }

    function closeAcceptModal() {
        document.getElementById('accept_modal').close();
    }

    function closeRejectModal() {
        document.getElementById('reject_modal').close();
    }
</script>
