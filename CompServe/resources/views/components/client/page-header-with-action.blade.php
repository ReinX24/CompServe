@props([
    'title' => '',
    'description' => '',
    'buttonText' => '',
    'buttonLink' => '#',
])

<div
    class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 bg-base-200 p-5 rounded-xl shadow-sm">
    <div>
        <h1 class="text-2xl font-bold text-primary">
            {{ $title }}
        </h1>
        <p class="mt-1 text-base-content/70">
            {{ $description }}
        </p>
    </div>

    @if ($buttonText)
        <div class="mt-3 md:mt-0">
            <a href="{{ $buttonLink }}"
                class="btn btn-primary shadow-md">
                + {{ $buttonText }}
            </a>
        </div>
    @endif
</div>
