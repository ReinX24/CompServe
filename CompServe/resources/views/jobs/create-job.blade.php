<x-layouts.app>
    <!-- Enhanced Breadcrumbs -->
    <div class="breadcrumbs text-sm mb-6">
        <ul class="text-base-content/70">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="hover:text-primary transition-colors duration-200 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ $jobType === 'gig' ? route('client.gigs.index') : ($jobType === 'contract' ? route('client.contracts.index') : route('client.gigs.index')) }}"
                    class="hover:text-primary transition-colors duration-200">
                    {{ $jobType === 'gig' ? __('All Gigs') : ($jobType === 'contract' ? __('All Contracts') : __('All Jobs')) }}
                </a>
            </li>
            <li class="text-primary font-semibold">
                {{ $jobType === 'gig' ? 'Create Gig' : ($jobType === 'contract' ? 'Create Contract' : 'Create Job') }}
            </li>
        </ul>
    </div>

    <div class="max-w-4xl mx-auto">
        {{-- Hero Header --}}
        <div
            class="relative overflow-hidden bg-linear-to-br from-primary/10 via-secondary/5 to-accent/10 rounded-2xl shadow-xl mb-8 border border-base-300/50">
            <!-- Decorative Background -->
            <div class="absolute inset-0 opacity-5">
                <div
                    class="absolute top-0 left-0 w-40 h-40 bg-primary rounded-full blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-60 h-60 bg-secondary rounded-full blur-3xl">
                </div>
            </div>

            <div class="relative p-8 md:p-10 text-center">
                <!-- Icon -->
                <div class="inline-flex items-center justify-center mb-4">
                    <div
                        class="bg-linear-to-br from-primary to-primary/70 p-4 rounded-2xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-12 h-12 text-white">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1
                    class="text-3xl md:text-4xl font-bold text-base-content mb-2">
                    {{ $jobType === 'gig' ? __('Create a New Gig') : ($jobType === 'contract' ? __('Create a New Contract') : __('Create a New Job')) }}
                </h1>
                <p
                    class="text-base md:text-lg text-base-content/70 max-w-2xl mx-auto">
                    {{ $jobType === 'gig' ? __('Fill out the details to post a gig and find the perfect freelancer.') : ($jobType === 'contract' ? __('Fill out the details to post a contract and connect with professionals.') : __('Fill out the details to post a job.')) }}
                </p>
            </div>
        </div>

        {{-- Main Form Card --}}
        <div class="relative">
            <!-- Glowing effect -->
            <div
                class="absolute -inset-0.5 bg-linear-to-r from-primary/5 to-secondary/5 rounded-2xl opacity-0 group-hover:opacity-100 transition duration-500 blur">
            </div>

            <div
                class="relative bg-base-100 rounded-2xl shadow-xl border-2 border-primary/20 overflow-hidden">
                <!-- Decorative top border -->
                <div
                    class="h-2 bg-linear-to-r from-primary via-secondary to-accent">
                </div>

                <div class="p-6 md:p-8">
                    {{-- Alpine.js Wrapper --}}
                    <div x-data="{
                        jobType: '{{ old('duration_type', $jobType ?? 'gig') }}',
                        durations: {
                            gig: ['1 day', '3 days', '5 days', '1 week', '1 month'],
                            contract: ['1 day', '3 days', '5 days', '1 week', '1 month', '3 months', '6 months', '1 year']
                        }
                    }">
                        <form action="{{ route('client.jobs.store') }}"
                            method="POST"
                            class="space-y-6">
                            @csrf

                            {{-- Job Type Selector (Highlighted) --}}
                            <div
                                class="bg-linear-to-br from-primary/5 to-secondary/5 rounded-xl p-6 border border-primary/20">
                                <label
                                    class="text-sm font-bold text-base-content mb-3 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-primary"
                                        viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Job Type</span>
                                    <span
                                        class="badge badge-primary badge-sm">Required</span>
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="relative cursor-pointer">
                                        <input type="radio"
                                            name="duration_type"
                                            value="gig"
                                            x-model="jobType"
                                            class="peer sr-only"
                                            {{ old('duration_type', $jobType ?? '') == 'gig' ? 'checked' : '' }}>
                                        <div
                                            class="bg-base-100 border-2 border-base-300 rounded-xl p-4 transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/10 peer-checked:shadow-lg hover:border-primary/50">
                                            <div
                                                class="flex items-center gap-3">
                                                <div
                                                    class="bg-primary/10 p-2 rounded-lg peer-checked:bg-primary peer-checked:text-white transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-bold text-base-content">
                                                        Gig</p>
                                                    <p
                                                        class="text-xs text-base-content/60">
                                                        Short-term task</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="relative cursor-pointer">
                                        <input type="radio"
                                            name="duration_type"
                                            value="contract"
                                            x-model="jobType"
                                            class="peer sr-only"
                                            {{ old('duration_type', $jobType ?? '') == 'contract' ? 'checked' : '' }}>
                                        <div
                                            class="bg-base-100 border-2 border-base-300 rounded-xl p-4 transition-all duration-200 peer-checked:border-secondary peer-checked:bg-secondary/10 peer-checked:shadow-lg hover:border-secondary/50">
                                            <div
                                                class="flex items-center gap-3">
                                                <div
                                                    class="bg-secondary/10 p-2 rounded-lg peer-checked:bg-secondary peer-checked:text-white transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-bold text-base-content">
                                                        Contract</p>
                                                    <p
                                                        class="text-xs text-base-content/60">
                                                        Long-term project</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Job Title --}}
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-bold text-base-content flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-primary"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span>Title</span>
                                    <span
                                        class="badge badge-primary badge-sm">Required</span>
                                </label>
                                <label
                                    class="input input-lg w-full {{ $errors->has('title') ? 'input-error' : 'input-primary' }} flex items-center gap-3 shadow-sm hover:shadow-md transition-shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-5 h-5 text-primary">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 6h.008v.008H6V6Z" />
                                    </svg>
                                    <input type="text"
                                        name="title"
                                        class="grow text-base"
                                        placeholder="e.g., Laptop Repair, Phone Repair, Data Recovery"
                                        value="{{ old('title') }}" />
                                </label>
                                @error('title')
                                    <div role="alert"
                                        class="alert alert-error shadow-md rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- Job Description --}}
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-bold text-base-content flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-primary"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                    <span>Description</span>
                                    <span
                                        class="badge badge-primary badge-sm">Required</span>
                                </label>
                                <textarea name="description"
                                    rows="5"
                                    placeholder="Provide detailed information about the job requirements, expectations, and deliverables..."
                                    class="textarea textarea-lg textarea-primary w-full {{ $errors->has('description') ? 'textarea-error' : '' }} shadow-sm hover:shadow-md transition-shadow">{{ old('description') }}</textarea>
                                @error('description')
                                    <div role="alert"
                                        class="alert alert-error shadow-md rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-bold text-base-content flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-primary"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span>Category</span>
                                    <span
                                        class="badge badge-primary badge-sm">Required</span>
                                </label>
                                <select name="category"
                                    class="select select-lg select-primary w-full {{ $errors->has('category') ? 'select-error' : '' }} shadow-sm hover:shadow-md transition-shadow">
                                    <option disabled
                                        selected>Select a category</option>
                                    <option value="Hardware"
                                        {{ old('category') == 'Hardware' ? 'selected' : '' }}>
                                        🔧 Hardware</option>
                                    <option value="DesktopComputers"
                                        {{ old('category') == 'DesktopComputers' ? 'selected' : '' }}>
                                        🖥️ Desktop Computers</option>
                                    <option value="LaptopComputers"
                                        {{ old('category') == 'LaptopComputers' ? 'selected' : '' }}>
                                        💻 Laptop Computers</option>
                                    <option value="MobilePhones"
                                        {{ old('category') == 'MobilePhones' ? 'selected' : '' }}>
                                        📱 Mobile Phones</option>
                                    <option value="Accessories"
                                        {{ old('category') == 'Accessories' ? 'selected' : '' }}>
                                        🎧 Computer Accessories</option>
                                    <option value="Networking"
                                        {{ old('category') == 'Networking' ? 'selected' : '' }}>
                                        🌐 Networking</option>
                                </select>
                                @error('category')
                                    <div role="alert"
                                        class="alert alert-error shadow-md rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- Skills Required --}}
                            <div x-data="{ skills: {{ json_encode(old('skills_required', [''])) }} }"
                                class="space-y-3">
                                <label
                                    class="text-sm font-bold text-base-content flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-primary"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    <span>Skills Required</span>
                                </label>

                                <div class="space-y-3">
                                    <template x-for="(skill, index) in skills"
                                        :key="index">
                                        <div class="flex gap-2">
                                            <label
                                                class="input input-primary w-full flex items-center gap-3 shadow-sm hover:shadow-md transition-shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-5 h-5 text-primary">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                                <input type="text"
                                                    x-model="skills[index]"
                                                    :name="'skills_required[' + index +
                                                        ']'"
                                                    class="grow"
                                                    placeholder="e.g., Hardware Diagnostics, Soldering" />
                                            </label>
                                            <button type="button"
                                                @click="skills.splice(index, 1)"
                                                class="btn btn-error btn-square shadow-md hover:shadow-lg hover:scale-105 transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                </div>

                                <button type="button"
                                    @click="skills.push('')"
                                    class="btn btn-success gap-2 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Add Another Skill
                                </button>

                                @error('skills_required')
                                    <div role="alert"
                                        class="alert alert-error shadow-md rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- Budget Section --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label
                                        class="text-sm font-bold text-base-content flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-primary"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Budget Type</span>
                                    </label>
                                    <select name="budget_type"
                                        class="select select-lg select-primary w-full {{ $errors->has('budget_type') ? 'select-error' : '' }} shadow-sm hover:shadow-md transition-shadow">
                                        <option value="fixed"
                                            {{ old('budget_type') == 'fixed' ? 'selected' : '' }}>
                                            💰 Fixed Price</option>
                                        <option value="hourly"
                                            {{ old('budget_type') == 'hourly' ? 'selected' : '' }}>
                                            ⏱️ Hourly Rate</option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-sm font-bold text-base-content flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-primary"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Budget (₱)</span>
                                        <span
                                            class="badge badge-primary badge-sm">Required</span>
                                    </label>
                                    <label
                                        class="input input-lg w-full {{ $errors->has('budget') ? 'input-error' : 'input-primary' }} flex items-center gap-3 shadow-sm hover:shadow-md transition-shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-5 h-5 text-primary">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <input type="number"
                                            name="budget"
                                            class="grow text-base"
                                            value="{{ old('budget') }}"
                                            placeholder="150.00"
                                            step="0.01"
                                            min="0" />
                                    </label>
                                    @error('budget')
                                        <div role="alert"
                                            class="alert alert-error shadow-md rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Location & Deadline --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label
                                        class="text-sm font-bold text-base-content flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-primary"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>Location</span>
                                    </label>
                                    <label
                                        class="input input-lg w-full {{ $errors->has('location') ? 'input-error' : 'input-primary' }} flex items-center gap-3 shadow-sm hover:shadow-md transition-shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-5 h-5 text-primary">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                        <input type="text"
                                            name="location"
                                            class="grow text-base"
                                            value="{{ old('location') }}"
                                            placeholder="e.g., Dagupan City, Remote" />
                                    </label>
                                    @error('location')
                                        <div role="alert"
                                            class="alert alert-error shadow-md rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-sm font-bold text-base-content flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-primary"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Deadline</span>
                                    </label>
                                    <label
                                        class="input input-lg input-primary w-full {{ $errors->has('deadline') ? 'input-error' : '' }} flex items-center gap-3 shadow-sm hover:shadow-md transition-shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-5 h-5 text-primary">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                        </svg>
                                        <input type="date"
                                            name="deadline"
                                            class="grow text-base"
                                            value="{{ old('deadline') }}" />
                                    </label>
                                    @error('deadline')
                                        <div role="alert"
                                            class="alert alert-error shadow-md rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Duration --}}
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-bold text-base-content flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-primary"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Duration</span>
                                    <span
                                        class="badge badge-primary badge-sm">Required</span>
                                </label>
                                <select name="duration"
                                    class="select select-lg select-primary w-full {{ $errors->has('duration') ? 'select-error' : '' }} shadow-sm hover:shadow-md transition-shadow">
                                    <option value=""
                                        disabled
                                        {{ old('duration') ? '' : 'selected' }}>
                                        Select duration
                                    </option>
                                    <template x-for="d in durations[jobType]"
                                        :key="d">
                                        <option :value="d"
                                            x-text="d"
                                            :selected="d === '{{ old('duration') }}'">
                                        </option>
                                    </template>
                                </select>
                                @error('duration')
                                    <div role="alert"
                                        class="alert alert-error shadow-md rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full btn btn-primary btn-lg gap-3 shadow-2xl hover:shadow-primary/50 hover:scale-105 transition-all duration-300 group"
                                    x-text="jobType === 'gig' ? '🚀 Post Gig' : '📝 Post Contract'">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Helpful Tips Section --}}
        <div
            class="mt-8 bg-linear-to-br from-info/5 to-info/10 border border-info/30 rounded-2xl p-6 shadow-lg">
            <div class="flex items-start gap-4">
                <div class="bg-info/10 p-3 rounded-xl shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-info"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-base-content mb-2">💡
                        Tips for Better Results</h3>
                    <ul class="space-y-2 text-sm text-base-content/70">
                        <li class="flex items-start gap-2">
                            <span class="text-success font-bold">✓</span>
                            <span>Write a clear and detailed job description to
                                attract qualified freelancers</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-success font-bold">✓</span>
                            <span>Set realistic budgets and deadlines based on
                                project complexity</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-success font-bold">✓</span>
                            <span>List all required skills to help freelancers
                                understand your needs</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Styles --}}
    <style>
        /* Smooth transitions for all interactive elements */
        input:focus,
        textarea:focus,
        select:focus {
            transform: translateY(-1px);
        }

        /* Custom radio button styling */
        input[type="radio"]:checked+div {
            animation: pulse 0.3s ease-in-out;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }
    </style>
</x-layouts.app>
