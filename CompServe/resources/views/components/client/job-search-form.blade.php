{{-- resources/views/components/freelancer/job-search-form.blade.php --}}

@props(['route'])

<div class="mb-6">
    <form method="GET"
        action="{{ $route ?? route('freelancer.jobs.available') }}"
        class="flex flex-col md:flex-row flex-wrap gap-3 items-stretch w-full">

        {{-- Search by job --}}
        <input type="text"
            name="search"
            placeholder="🔍 Search by title or description"
            value="{{ request('search') ?? '' }}"
            class="input input-bordered w-full md:w-64 bg-base-100 dark:bg-base-200" />

        {{-- Status Select (only on client.gigs.index) --}}
        @if (request()->routeIs('client.gigs.index') ||
                request()->routeIs('client.contracts.index'))
            <select name="status"
                class="select select-bordered w-full md:w-auto bg-base-100 dark:bg-base-200">
                <option value="">{{ __('All Status') }}</option>
                <option value="open"
                    {{ request('status') == 'open' ? 'selected' : '' }}>Open
                </option>
                <option value="in_progress"
                    {{ request('status') == 'in_progress' ? 'selected' : '' }}>
                    In Progress</option>
                <option value="completed"
                    {{ request('status') == 'completed' ? 'selected' : '' }}>
                    Completed</option>
                <option value="cancelled"
                    {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                    Cancelled</option>
            </select>
        @endif

        {{-- Category Select --}}
        <select name="category"
            class="select select-bordered w-full md:w-auto bg-base-100 dark:bg-base-200">
            <option value="">{{ __('All Categories') }}</option>
            <option value="Hardware"
                {{ request('category') == 'Hardware' ? 'selected' : '' }}>
                Hardware
            </option>
            <option value="DesktopComputers"
                {{ request('category') == 'DesktopComputers' ? 'selected' : '' }}>
                Desktop Computers
            </option>
            <option value="LaptopComputers"
                {{ request('category') == 'LaptopComputers' ? 'selected' : '' }}>
                Laptop Computers
            </option>
            <option value="MobilePhones"
                {{ request('category') == 'MobilePhones' ? 'selected' : '' }}>
                Mobile Phones
            </option>
            <option value="Accessories"
                {{ request('category') == 'Accessories' ? 'selected' : '' }}>
                Computer Accessories
            </option>
            <option value="Networking"
                {{ request('category') == 'Networking' ? 'selected' : '' }}>
                Networking
            </option>
        </select>

        {{-- Search by client --}}
        <input type="text"
            name="client"
            placeholder="👤 Search by client"
            value="{{ request('client') ?? '' }}"
            class="input input-bordered w-full md:w-64 bg-base-100 dark:bg-base-200" />

        {{-- Search by location --}}
        <input type="text"
            name="location"
            placeholder="📍 Search by location"
            value="{{ request('location') ?? '' }}"
            class="input input-bordered w-full md:w-64 bg-base-100 dark:bg-base-200" />

        {{-- Buttons container --}}
        <div class="flex gap-2 w-full md:w-auto">
            {{-- Submit button --}}
            <button type="submit"
                class="btn btn-primary w-full md:w-auto gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <span class="hidden md:inline">Search</span>
            </button>

            {{-- Reset button --}}
            <a href="{{ $route ?? route('freelancer.jobs.available') }}"
                class="btn btn-neutral w-full md:w-auto gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="hidden md:inline">Reset</span>
            </a>
        </div>
    </form>
</div>
