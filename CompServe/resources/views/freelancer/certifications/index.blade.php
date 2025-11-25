<x-layouts.app>
    <div class="container mx-auto p-6">

        <!-- Page Header -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4 bg-base-200 p-5 rounded-xl shadow-sm border border-base-300">
            <div>
                <h1
                    class="text-3xl font-extrabold flex items-center gap-2 text-primary">
                    🎓 My Certifications
                </h1>
                <p class="text-base-content/70 mt-1">
                    Showcase your verified skills and qualifications ✨
                </p>
            </div>

            <a href="{{ route('freelancer.certifications.create') }}"
                class="btn btn-primary w-full md:w-auto flex items-center gap-2">
                ➕ Apply for Certification
            </a>
        </div>

        <!-- Certifications Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($certifications as $cert)
                <x-freelancer.cert-card :cert="$cert" />
            @empty
                <div class="col-span-full">
                    <div
                        class="alert alert-info shadow-sm rounded-xl flex items-center gap-3 p-4">
                        <span class="text-2xl">📭</span>
                        <span class="text-base-content">
                            No certifications found. You can apply for one
                            above.
                        </span>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</x-layouts.app>
