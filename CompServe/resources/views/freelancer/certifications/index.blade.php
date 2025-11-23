<x-layouts.app>
    <div class="container mx-auto p-6">

        <!-- Page Header -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-3">
            <h1 class="text-3xl font-bold">My Certifications</h1>

            <a href="{{ route('freelancer.certifications.create') }}"
                class="btn btn-primary w-full md:w-auto">
                Apply for Certification
            </a>
        </div>

        <!-- Certifications Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($certifications as $cert)
                <x-freelancer.cert-card :cert="$cert" />
            @empty
                <div class="col-span-full">
                    <div class="alert alert-info shadow-sm">
                        <span>No certifications found. You can apply for one
                            above.</span>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</x-layouts.app>
