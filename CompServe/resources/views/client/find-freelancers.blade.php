<x-layouts.app>
    <div
        class="min-h-screen bg-linear-to-br from-blue-50 via-white to-purple-50">
        <!-- Header -->
        <div class="mb-8">
            <div
                class="relative overflow-hidden rounded-3xl bg-linear-to-r from-blue-500 via-purple-500 to-blue-600 p-8 shadow-2xl mx-4 mt-8">
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

                <div
                    class="relative flex items-center justify-between flex-wrap gap-6">
                    <!-- Left: Bot Avatar and Title -->
                    <div class="flex items-center gap-6">
                        <!-- Animated Bot Avatar -->
                        <div class="relative">
                            <div
                                class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/30 shadow-lg transform hover:scale-110 transition-transform">
                                <span class="text-5xl animate-bounce">💼</span>
                            </div>
                            <div
                                class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-400 rounded-full border-4 border-white animate-pulse">
                            </div>
                        </div>
                        <div>
                            <h1
                                class="text-4xl font-extrabold tracking-tight text-white mb-2">
                                Find Nearby Freelancers
                            </h1>
                            <p
                                class="text-lg text-blue-100 flex items-center gap-2 flex-wrap">
                                <svg class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Find Nearby Talent • Location-Based • Real-Time
                                Search
                            </p>
                        </div>
                    </div>

                    <!-- Right: User Profile -->
                    <div
                        class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-3 border border-white/20">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-white">
                                {{ auth()->user()->name }}</p>
                            <p class="text-xs text-blue-100">
                                {{ auth()->user()->email }}</p>
                        </div>
                        <div
                            class="w-12 h-12 bg-linear-to-br from-purple-400 to-pink-500 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8 max-w-6xl">

            <!-- Location Card with Enhanced Styling -->
            <div
                class="mb-8 p-6 rounded-2xl bg-white shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center gap-3 mb-4">
                    <div
                        class="w-10 h-10 bg-linear-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-xl">📍</span>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Your Location
                    </h2>
                </div>

                @if (auth()->user()->latitude && auth()->user()->longitude)
                    <div
                        class="bg-linear-to-r from-green-50 to-emerald-50 rounded-xl p-4 mb-4">
                        <p class="text-sm text-gray-700 space-y-1">
                            <span
                                class="font-semibold text-green-700">Latitude:</span>
                            <span id="lat"
                                class="font-mono text-green-900">{{ auth()->user()->latitude }}</span>
                            <br>
                            <span
                                class="font-semibold text-green-700">Longitude:</span>
                            <span id="lng"
                                class="font-mono text-green-900">{{ auth()->user()->longitude }}</span>
                        </p>

                        <div class="flex items-center gap-2 mt-3">
                            <div
                                class="w-2 h-2 bg-green-500 rounded-full animate-pulse">
                            </div>
                            <p class="text-sm text-green-700 font-medium">
                                Location enabled</p>
                        </div>
                    </div>

                    <button id="disableLocation"
                        class="px-6 py-2.5 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                        Disable Location
                    </button>
                @else
                    <div
                        class="bg-gray-50 rounded-xl p-4 mb-4 border-2 border-dashed border-gray-200">
                        <p id="locationStatus"
                            class="text-sm text-gray-600">Location not enabled
                        </p>
                    </div>

                    <button id="enableLocation"
                        class="px-6 py-2.5 bg-linear-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Enable Location
                    </button>
                @endif
            </div>

            <!-- Header Section with Search -->
            <div class="mb-6">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Nearby
                            Freelancers</h1>
                        <div
                            class="h-1 w-24 bg-linear-to-r from-blue-500 to-purple-600 rounded-full">
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <div class="relative w-full md:w-96">
                        <input type="text"
                            id="searchInput"
                            placeholder="Search by name, email..."
                            class="w-full px-4 py-3 pl-12 pr-4 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition-all duration-200 bg-white shadow-sm">
                        <span
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl">🔍</span>
                        <button id="clearSearch"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors hidden">✕</button>
                    </div>
                </div>

                <!-- Search Results Counter -->
                <p id="searchResults"
                    class="text-sm text-gray-600 hidden">
                    <span id="resultCount"></span>
                </p>
            </div>

            @isset($error)
                <div
                    class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <p class="text-red-700 text-sm font-medium">{{ $error }}
                    </p>
                </div>
            @endisset

            @if ($freelancers->isEmpty())
                <div id="emptyState"
                    class="text-center py-16">
                    <div
                        class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-4xl">🔍</span>
                    </div>
                    <p class="text-gray-500 text-lg">No freelancers found
                        nearby.</p>
                    <p class="text-gray-400 text-sm mt-2">Try enabling your
                        location to find freelancers in your area.</p>
                </div>
            @else
                <div id="freelancerGrid"
                    class="grid md:grid-cols-2 gap-6">
                    @foreach ($freelancers as $freelancer)
                        <div class="freelancer-card group p-6 border border-gray-200 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 bg-white hover:border-purple-200 hover:-translate-y-1"
                            data-name="{{ strtolower($freelancer->name) }}"
                            data-email="{{ strtolower($freelancer->email ?? '') }}"
                            data-distance="{{ $freelancer->distance }}">
                            <!-- Profile Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 bg-linear-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                                        {{ substr($freelancer->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h2
                                            class="font-bold text-lg text-gray-900 group-hover:text-purple-600 transition-colors">
                                            {{ $freelancer->name }}
                                        </h2>
                                        <div
                                            class="flex items-center gap-1 mt-1">
                                            <span
                                                class="text-xs text-gray-500">📍</span>
                                            <span
                                                class="text-sm text-gray-600 font-medium">
                                                {{ round($freelancer->distance, 1) }}
                                                km away
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                <p class="text-sm text-gray-700">
                                    <span class="text-gray-500">✉️</span>
                                    {{ $freelancer->email ?? 'No email provided.' }}
                                </p>
                            </div>

                            <!-- View Profile Link -->
                            <a href="{{ route('freelancer.profile', $freelancer->id) }}"
                                class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-medium text-sm group-hover:gap-3 transition-all duration-200">
                                View Profile
                                <span
                                    class="transform group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- No Search Results State (hidden by default) -->
                <div id="noSearchResults"
                    class="text-center py-16 hidden">
                    <div
                        class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-4xl">🤷</span>
                    </div>
                    <p class="text-gray-500 text-lg">No freelancers match your
                        search.</p>
                    <p class="text-gray-400 text-sm mt-2">Try adjusting your
                        search terms.</p>
                </div>
            @endif

        </div>
    </div>

    <script>
        // Search Functionality with Debouncing
        const searchInput = document.getElementById('searchInput');
        const clearSearchBtn = document.getElementById('clearSearch');
        const searchResults = document.getElementById('searchResults');
        const resultCount = document.getElementById('resultCount');
        const freelancerCards = document.querySelectorAll('.freelancer-card');
        const freelancerGrid = document.getElementById('freelancerGrid');
        const noSearchResults = document.getElementById('noSearchResults');
        const emptyState = document.getElementById('emptyState');

        if (searchInput && freelancerCards.length > 0) {
            let searchTimeout;

            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase().trim();

                // Show/hide clear button
                if (searchTerm) {
                    clearSearchBtn.classList.remove('hidden');
                } else {
                    clearSearchBtn.classList.add('hidden');
                }

                // Debounce search for performance
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    let visibleCount = 0;

                    freelancerCards.forEach(card => {
                        const name = card.dataset.name;
                        const email = card.dataset.email;
                        const distance = card.dataset
                            .distance;

                        // Search in name, email, and distance
                        const matches = name.includes(
                                searchTerm) ||
                            email.includes(searchTerm) ||
                            distance.includes(searchTerm);

                        if (matches || searchTerm === '') {
                            card.style.display = 'block';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update results counter and show/hide no results message
                    if (searchTerm) {
                        searchResults.classList.remove('hidden');
                        resultCount.textContent =
                            `Found ${visibleCount} freelancer${visibleCount !== 1 ? 's' : ''}`;

                        if (visibleCount === 0) {
                            if (freelancerGrid) freelancerGrid
                                .classList.add('hidden');
                            if (noSearchResults) noSearchResults
                                .classList.remove('hidden');
                        } else {
                            if (freelancerGrid) freelancerGrid
                                .classList.remove('hidden');
                            if (noSearchResults) noSearchResults
                                .classList.add('hidden');
                        }
                    } else {
                        searchResults.classList.add('hidden');
                        if (freelancerGrid) freelancerGrid.classList
                            .remove('hidden');
                        if (noSearchResults) noSearchResults
                            .classList.add('hidden');
                    }
                }, 300); // Wait 300ms after user stops typing
            });

            // Clear search
            clearSearchBtn.addEventListener('click', () => {
                searchInput.value = '';
                searchInput.dispatchEvent(new Event('input'));
                searchInput.focus();
            });
        }

        // Location Enable Functionality
        const btn = document.getElementById('enableLocation');

        if (btn) {
            btn.addEventListener('click', () => {
                if (!navigator.geolocation) {
                    document.getElementById('locationStatus').innerText =
                        'Geolocation is not supported by your browser';
                    return;
                }

                document.getElementById('locationStatus').innerHTML =
                    '<span class="text-blue-600 font-medium">🔄 Requesting location permission...</span>';

                navigator.geolocation.getCurrentPosition(
                    position => {
                        fetch('/location/update', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    latitude: position
                                        .coords.latitude,
                                    longitude: position
                                        .coords.longitude
                                })
                            })
                            .then(res => {
                                if (!res.ok) throw new Error(
                                    'Failed to save location'
                                );
                                return res.json();
                            })
                            .then(() => {
                                document.getElementById(
                                        'locationStatus')
                                    .innerHTML = `
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-green-600 font-medium">
                                        📍 Location enabled<br>
                                        <span class="text-sm text-gray-600">
                                            Latitude: ${position.coords.latitude}<br>
                                            Longitude: ${position.coords.longitude}
                                        </span>
                                    </span>
                                </div>
                            `;
                                // Reload after successful save
                                setTimeout(() => window.location
                                    .reload(), 500);
                            })
                            .catch(error => {
                                document.getElementById(
                                        'locationStatus')
                                    .innerHTML =
                                    '<span class="text-red-600 font-medium">❌ Failed to save location. Please try again.</span>';
                                console.error(
                                    'Location save error:',
                                    error);
                            });
                    },
                    error => {
                        let message = 'Unable to get location';

                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                message =
                                    '❌ Location permission denied';
                                break;
                            case error.POSITION_UNAVAILABLE:
                                message = '📍 Location unavailable';
                                break;
                            case error.TIMEOUT:
                                message =
                                    '⏱️ Location request timed out';
                                break;
                        }

                        document.getElementById('locationStatus')
                            .innerHTML =
                            `<span class="text-red-600 font-medium">${message}</span>`;
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000
                    }
                );
            });
        }

        // Location Disable Functionality
        const disableBtn = document.getElementById('disableLocation');

        if (disableBtn) {
            disableBtn.addEventListener('click', () => {
                if (!confirm(
                        'Are you sure you want to disable location?')) {
                    return;
                }

                fetch('/location/disable', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error(
                            'Failed to disable location');
                        return res.json();
                    })
                    .then(() => {
                        window.location.reload();
                    })
                    .catch(error => {
                        alert(
                            'Error disabling location. Please try again.'
                        );
                        console.error('Disable location error:', error);
                    });
            });
        }
    </script>

</x-layouts.app>
