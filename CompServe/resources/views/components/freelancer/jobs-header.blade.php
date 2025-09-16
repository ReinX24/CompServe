{{-- resources/views/components/freelancer/jobs-header.blade.php --}}

<div class="flex justify-between items-center mb-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ $title ?? __('N/A') }}
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            {{ $subtitle ?? __('N/A') }}
        </p>
    </div>
</div>
