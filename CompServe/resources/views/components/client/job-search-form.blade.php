{{-- resources/views/components/freelancer/job-search-form.blade.php --}}

@props(['route'])

<div class="mb-6">
    <form method="GET"
        action="{{ $route ?? route('freelancer.jobs.available') }}"
        class="flex flex-col md:flex-row md:flex-wrap gap-3 items-stretch w-full">

        {{-- Search by job --}}
        <input type="text"
            name="search"
            placeholder="🔍 Search by title or description"
            value="{{ request('search') ?? '' }}"
            class="input input-bordered w-full md:w-64 bg-base-100" />

        {{-- Status Select (only on client.gigs.index and client.contracts.index) --}}
        {{-- @if (request()->routeIs('client.gigs.index') ||
                request()->routeIs('client.contracts.index')) --}}
            <select name="status"
                class="select select-bordered w-full md:w-auto bg-base-100">
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
        {{-- @endif --}}

        {{-- Category Select --}}
        <select name="category"
            class="select select-bordered w-full md:w-auto bg-base-100">
            <option value="">All Categories</option>
            <option value="Hardware"
                {{ request('category') == 'Hardware' ? 'selected' : '' }}>
                Hardware</option>
            <option value="DesktopComputers"
                {{ request('category') == 'DesktopComputers' ? 'selected' : '' }}>
                Desktop Computers</option>
            <option value="LaptopComputers"
                {{ request('category') == 'LaptopComputers' ? 'selected' : '' }}>
                Laptop Computers</option>
            <option value="MobilePhones"
                {{ request('category') == 'MobilePhones' ? 'selected' : '' }}>
                Mobile Phones</option>
            <option value="Accessories"
                {{ request('category') == 'Accessories' ? 'selected' : '' }}>
                Accessories</option>
            <option value="Networking"
                {{ request('category') == 'Networking' ? 'selected' : '' }}>
                Networking</option>
        </select>

        {{-- Search by client --}}
        <input type="text"
            name="client"
            placeholder="👤 Search by client"
            value="{{ request('client') ?? '' }}"
            class="input input-bordered w-full md:w-64 bg-base-100" />

        {{-- Search by location --}}
        <input type="text"
            name="location"
            placeholder="📍 Search by location"
            value="{{ request('location') ?? '' }}"
            class="input input-bordered w-full md:w-64 bg-base-100" />

        {{-- Buttons (auto moves to the far right on desktop) --}}
        <div
            class="flex flex-col md:flex-row w-full md:w-auto gap-2 md:ml-auto">

            {{-- Submit button --}}
            <button type="submit"
                class="btn btn-primary w-full md:w-auto flex items-center justify-center gap-2 hover:scale-105 transition-all">
                🔍
                <span>Search</span>
            </button>

            {{-- Reset button --}}
            <a href="{{ $route ?? route('freelancer.jobs.available') }}"
                class="btn btn-neutral w-full md:w-auto flex items-center justify-center gap-2 hover:scale-105 transition-all">
                ♻️
                <span>Reset</span>
            </a>
        </div>
    </form>
</div>
