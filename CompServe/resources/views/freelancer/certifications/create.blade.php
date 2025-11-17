<x-layouts.app>
    <div class="container mx-auto p-6 max-w-xl">
        <h1 class="text-2xl font-bold mb-4">Apply for Certification</h1>

        <form action="{{ route('freelancer.certifications.store') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf

            <label class="font-semibold">Certification Type</label>
            <select name="type"
                class="select select-bordered w-full mb-4"
                required>
                <option value="">Select Certification</option>
                <option value="NC I">NC I</option>
                <option value="NC II">NC II</option>
                <option value="NC III">NC III</option>
                <option value="NC IV">NC IV</option>
                <option value="Tech Certification">Tech Certification
                    (TESDA/DICT/Other)</option>
            </select>

            <label>Description (optional)</label>
            <textarea name="description"
                class="textarea textarea-bordered w-full mb-4"></textarea>

            <label>Upload Certification Document</label>
            <input type="file"
                name="document"
                class="file-input file-input-bordered w-full mb-4"
                required>

            <button class="btn btn-primary w-full">Submit</button>
        </form>
    </div>
</x-layouts.app>
