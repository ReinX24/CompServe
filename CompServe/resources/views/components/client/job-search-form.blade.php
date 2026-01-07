{{-- resources/views/components/freelancer/job-search-form.blade.php --}}
@props(['route'])
<div class="mb-8">
    <!-- Card with Gradient Background (CompBot Style) -->
    <div
        class="relative overflow-hidden rounded-3xl bg-linear-to-r from-blue-500 via-purple-500 to-blue-600 shadow-2xl">
        <!-- Animated Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 left-0 w-40 h-40 bg-white rounded-full -translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 right-0 w-32 h-32 bg-white rounded-full translate-x-1/2 translate-y-1/2">
            </div>
            <div
                class="absolute top-1/2 left-1/2 w-24 h-24 bg-white rounded-full -translate-x-1/2 -translate-y-1/2">
            </div>
        </div>

        <div class="relative card-body p-6">
            <h2 class="card-title text-2xl mb-4 text-white">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Search & Filter
            </h2>

            <form method="GET"
                action="{{ $route ?? route('freelancer.jobs.available') }}"
                class="space-y-4">

                {{-- Row 1: Search and Status --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Search by job --}}
                    <div class="form-control">
                        <label class="label">
                            <span
                                class="label-text font-semibold text-blue-100">
                                <span class="mr-1">🔍</span>Search Jobs
                            </span>
                        </label>
                        <input type="text"
                            name="search"
                            placeholder="Enter job title or description..."
                            value="{{ request('search') ?? '' }}"
                            class="input input-bordered w-full bg-white/95 backdrop-blur-sm border-white/30 focus:border-white focus:ring-2 focus:ring-white/50 transition-all placeholder:text-gray-400" />
                    </div>

                    {{-- Status Select --}}
                    <div class="form-control">
                        <label class="label">
                            <span
                                class="label-text font-semibold text-blue-100">
                                <span class="mr-1">📊</span>Status
                            </span>
                        </label>
                        <select name="status"
                            class="select select-bordered w-full bg-white/95 backdrop-blur-sm border-white/30 focus:border-white focus:ring-2 focus:ring-white/50 transition-all">
                            <option value="">{{ __('All Status') }}
                            </option>
                            <option value="open"
                                {{ request('status') == 'open' ? 'selected' : '' }}>
                                🟢 Open
                            </option>
                            <option value="in_progress"
                                {{ request('status') == 'in_progress' ? 'selected' : '' }}>
                                🔵 In Progress
                            </option>
                            <option value="completed"
                                {{ request('status') == 'completed' ? 'selected' : '' }}>
                                ✅ Completed
                            </option>
                            <option value="cancelled"
                                {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                ❌ Cancelled
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Row 2: Category and Client --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Category Select --}}
                    <div class="form-control">
                        <label class="label">
                            <span
                                class="label-text font-semibold text-blue-100">
                                <span class="mr-1">🏷️</span>Category
                            </span>
                        </label>
                        <select name="category"
                            class="select select-bordered w-full bg-white/95 backdrop-blur-sm border-white/30 focus:border-white focus:ring-2 focus:ring-white/50 transition-all">
                            <option value="">All Categories</option>
                            <option value="Hardware"
                                {{ request('category') == 'Hardware' ? 'selected' : '' }}>
                                🔧 Hardware
                            </option>
                            <option value="DesktopComputers"
                                {{ request('category') == 'DesktopComputers' ? 'selected' : '' }}>
                                🖥️ Desktop Computers
                            </option>
                            <option value="LaptopComputers"
                                {{ request('category') == 'LaptopComputers' ? 'selected' : '' }}>
                                💻 Laptop Computers
                            </option>
                            <option value="MobilePhones"
                                {{ request('category') == 'MobilePhones' ? 'selected' : '' }}>
                                📱 Mobile Phones
                            </option>
                            <option value="Accessories"
                                {{ request('category') == 'Accessories' ? 'selected' : '' }}>
                                🎧 Accessories
                            </option>
                            <option value="Networking"
                                {{ request('category') == 'Networking' ? 'selected' : '' }}>
                                🌐 Networking
                            </option>
                        </select>
                    </div>

                    {{-- Search by client --}}
                    <div class="form-control">
                        <label class="label">
                            <span
                                class="label-text font-semibold text-blue-100">
                                <span class="mr-1">👤</span>Client Name
                            </span>
                        </label>
                        <input type="text"
                            name="client"
                            placeholder="Enter client name..."
                            value="{{ request('client') ?? '' }}"
                            class="input input-bordered w-full bg-white/95 backdrop-blur-sm border-white/30 focus:border-white focus:ring-2 focus:ring-white/50 transition-all placeholder:text-gray-400" />
                    </div>
                </div>

                {{-- Row 3: Location --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold text-blue-100">
                            <span class="mr-1">📍</span>Location
                        </span>
                    </label>
                    <input type="text"
                        name="location"
                        placeholder="Enter city, state, or country..."
                        value="{{ request('location') ?? '' }}"
                        class="input input-bordered w-full bg-white/95 backdrop-blur-sm border-white/30 focus:border-white focus:ring-2 focus:ring-white/50 transition-all placeholder:text-gray-400" />
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="submit"
                        class="btn bg-white hover:bg-blue-50 text-blue-600 border-0 flex-1 sm:flex-none sm:px-8 gap-2 hover:scale-105 transition-transform shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="font-semibold">Search Jobs</span>
                    </button>

                    <a href="{{ $route ?? route('freelancer.jobs.available') }}"
                        class="btn bg-white/20 hover:bg-white/30 text-white border-white/30 hover:border-white/50 backdrop-blur-sm flex-1 sm:flex-none sm:px-8 gap-2 hover:scale-105 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span class="font-semibold">Reset Filters</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
