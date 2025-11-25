<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li><a href="{{ route('freelancer.certifications.index') }}"
                    class="hover:text-primary">Certifications</a></li>
            <li class="text-primary font-semibold">Create Certification</li>
        </ul>
    </div>

    <div class="container mx-auto max-w-xl p-6">

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body space-y-4">

                <h1 class="text-3xl font-bold">Apply for Certification</h1>
                <p class="text-sm text-base-content/70">Submit your
                    certification
                    details below.</p>

                <form action="{{ route('freelancer.certifications.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <!-- Certification Type -->
                    <div class="form-control space-y-3">
                        <label class="label">
                            <span class="label-text font-semibold">Certification
                                Type</span>
                        </label>
                        <select name="type"
                            class="select select-bordered w-full"
                            required>
                            <option value="">Select Certification</option>
                            <option value="NC I">NC I</option>
                            <option value="NC II">NC II</option>
                            <option value="NC III">NC III</option>
                            <option value="NC IV">NC IV</option>
                            <option value="Tech Certification">Tech
                                Certification (TESDA/DICT/Other)</option>
                        </select>

                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-control space-y-2">
                        <label class="label">
                            <span class="label-text font-semibold">Description
                                (optional)</span>
                        </label>
                        <textarea name="description"
                            class="textarea textarea-bordered w-full h-24"
                            placeholder="Add details or notes"></textarea>

                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Upload Document -->
                    <div class="form-control space-y-3">
                        <label class="label">
                            <span class="label-text font-semibold">Upload
                                Certification Document</span>
                        </label>
                        <input type="file"
                            name="document"
                            class="file-input file-input-bordered w-full"
                            required>

                        @error('document')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button class="btn btn-primary w-full">Submit
                        Application</button>
                </form>

            </div>
        </div>

    </div>
</x-layouts.app>
