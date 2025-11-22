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

                {{-- <div class="card bg-base-200 shadow-sm border">
                    <div class="card-body">

                        <!-- Title -->
                        <h2 class="card-title text-xl font-semibold">
                            {{ $cert->type }}
                        </h2>

                        <!-- Description -->
                        @if ($cert->description)
                            <p class="text-sm text-base-content/70">
                                {{ $cert->description }}
                            </p>
                        @endif

                        <!-- Status -->
                        <div class="mt-3">
                            <div class="badge badge-info badge-lg">
                                {{ ucfirst($cert->status) }}
                            </div>
                        </div>

                        <!-- View Button -->
                        <div class="card-actions justify-end mt-4">
                            <a href="{{ Storage::url($cert->document_path) }}"
                                target="_blank"
                                class="btn btn-outline btn-secondary btn-sm w-full md:w-auto">
                                View Document
                            </a>
                        </div>

                    </div>
                </div> --}}
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
