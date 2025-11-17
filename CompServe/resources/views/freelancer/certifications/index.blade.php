<x-layouts.app>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">My Certifications</h1>

        <a href="{{ route('freelancer.certifications.create') }}"
            class="btn btn-primary mb-4">
            Apply for Certification
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($certifications as $cert)
                <div class="p-4 border rounded shadow">
                    <h2 class="font-semibold text-lg">{{ $cert->type }}</h2>
                    <p class="text-sm">{{ $cert->description }}</p>
                    <p class="mt-2">
                        <span
                            class="badge badge-info">{{ ucfirst($cert->status) }}</span>
                    </p>
                    <a class="btn btn-sm btn-outline mt-2"
                        href="{{ Storage::url($cert->document_path) }}"
                        target="_blank">
                        View Document
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
