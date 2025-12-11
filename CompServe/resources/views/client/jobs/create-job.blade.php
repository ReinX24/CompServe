<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>

            <li>
                <a
                    href="{{ $jobType === 'gig'
                        ? route('client.gigs.index')
                        : ($jobType === 'contract'
                            ? route('client.contracts.index')
                            : route('client.gigs.index')) }}">
                    {{ $jobType === 'gig'
                        ? __('All Gigs')
                        : ($jobType === 'contract'
                            ? __('All Contracts')
                            : __('All Jobs')) }}
                </a>
            </li>

            <li class="text-primary font-semibold">
                {{ $jobType === 'gig'
                    ? 'Create Gig'
                    : ($jobType === 'contract'
                        ? 'Create Contract'
                        : 'Create Job') }}
            </li>
        </ul>
    </div>

    <div class="max-w-3xl mx-auto">
        {{-- Header Section --}}
        <div class="text-center mb-6">
            <div class="flex justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-16 text-primary">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-base-content">
                {{ $jobType === 'gig'
                    ? __('Create a New Gig')
                    : ($jobType === 'contract'
                        ? __('Create a New Contract')
                        : __('Create a New Job')) }}
            </h1>
            <p class="text-base-content/70 mt-1">
                {{ $jobType === 'gig'
                    ? __('Fill out the details to post a gig.')
                    : ($jobType === 'contract'
                        ? __('Fill out the details to post a contract.')
                        : __('Fill out the details to post a job.')) }}
            </p>
        </div>

        {{-- Form Card --}}
        <div class="rounded-lg shadow-md border overflow-hidden border-primary">
            <div class="p-6">

                {{-- Alpine.js Wrapper for Job Type + Duration --}}
                <div x-data="{
                    jobType: '{{ old('duration_type', $jobType ?? 'gig') }}',
                    durations: {
                        gig: ['1 day', '3 days', '5 days', '1 week', '1 month'],
                        contract: ['1 day', '3 days', '5 days', '1 week', '1 month', '3 months', '6 months', '1 year']
                    }
                }">

                    <form action="{{ route('client.jobs.store') }}"
                        method="POST"
                        class="space-y-4">
                        @csrf

                        {{-- Job Title --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Job Title</span>
                            </label>
                            <label
                                class="input w-full {{ $errors->has('title') ? 'input-error' : 'input-primary' }}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-5">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 6h.008v.008H6V6Z" />
                                </svg>
                                <input type="text"
                                    name="title"
                                    class="grow"
                                    placeholder="Laptop Repair Specialist"
                                    value="{{ old('title') }}" />
                            </label>
                            @error('title')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Job Description --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Description</span>
                            </label>
                            <textarea name="description"
                                rows="4"
                                placeholder="Provide job details..."
                                class="textarea w-full {{ $errors->has('description') ? 'textarea-error' : 'textarea-primary' }}">{{ old('description') }}</textarea>
                            @error('description')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Job Type (Gig / Contract) - Dynamic --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Job Type</span>
                            </label>
                            <select name="duration_type"
                                x-model="jobType"
                                class="select w-full {{ $errors->has('duration_type') ? 'select-error' : 'select-primary' }}">
                                <option value="gig"
                                    {{ old('duration_type', $jobType ?? '') == 'gig' ? 'selected' : '' }}>
                                    Gig</option>
                                <option value="contract"
                                    {{ old('duration_type', $jobType ?? '') == 'contract' ? 'selected' : '' }}>
                                    Contract</option>
                            </select>
                        </div>

                        {{-- Category --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Category</span>
                            </label>
                            <select name="category"
                                class="select w-full {{ $errors->has('category') ? 'select-error' : 'select-primary' }}">
                                <option disabled
                                    selected>Select a category</option>
                                <option value="Hardware"
                                    {{ old('category') == 'Hardware' ? 'selected' : '' }}>
                                    Hardware</option>
                                <option value="DesktopComputers"
                                    {{ old('category') == 'DesktopComputers' ? 'selected' : '' }}>
                                    Desktop Computers</option>
                                <option value="LaptopComputers"
                                    {{ old('category') == 'LaptopComputers' ? 'selected' : '' }}>
                                    Laptop Computers</option>
                                <option value="MobilePhones"
                                    {{ old('category') == 'MobilePhones' ? 'selected' : '' }}>
                                    Mobile Phones</option>
                                <option value="Accessories"
                                    {{ old('category') == 'Accessories' ? 'selected' : '' }}>
                                    Computer Accessories</option>
                                <option value="Networking"
                                    {{ old('category') == 'Networking' ? 'selected' : '' }}>
                                    Networking</option>
                            </select>
                            @error('category')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Skills Required --}}
                        <div x-data="{ skills: {{ json_encode(old('skills_required', [''])) }} }"
                            class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Skills Required</span>
                            </label>

                            <template x-for="(skill, index) in skills"
                                :key="index">
                                <div class="flex gap-2">
                                    <label class="input input-primary w-full">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-5">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                        </svg>
                                        <input type="text"
                                            x-model="skills[index]"
                                            :name="'skills_required[' + index + ']'"
                                            class="grow"
                                            placeholder="Enter a skill" />
                                    </label>
                                    <button type="button"
                                        @click="skills.splice(index, 1)"
                                        class="btn btn-error btn-square">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-6">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            <button type="button"
                                @click="skills.push('')"
                                class="btn btn-success btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-5">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Add Skill
                            </button>

                            @error('skills_required')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Budget and Type --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-medium text-base-content">
                                    <span>Budget Type</span>
                                </label>
                                <select name="budget_type"
                                    class="select w-full {{ $errors->has('budget_type') ? 'select-error' : 'select-primary' }}">
                                    <option value="fixed"
                                        {{ old('budget_type') == 'fixed' ? 'selected' : '' }}>
                                        Fixed</option>
                                    <option value="hourly"
                                        {{ old('budget_type') == 'hourly' ? 'selected' : '' }}>
                                        Hourly</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-sm font-medium text-base-content">
                                    <span>Budget (₱)</span>
                                </label>
                                <label
                                    class="input w-full {{ $errors->has('budget') ? 'input-error' : 'input-primary' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <input type="number"
                                        name="budget"
                                        class="grow"
                                        value="{{ old('budget') }}"
                                        placeholder="150.00" />
                                </label>
                                @error('budget')
                                    <div role="alert"
                                        class="alert alert-error alert-soft mt-2">
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Location</span>
                            </label>
                            <label
                                class="input w-full {{ $errors->has('location') ? 'input-error' : 'input-primary' }}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-5">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <input type="text"
                                    name="location"
                                    class="grow"
                                    value="{{ old('location') }}"
                                    placeholder="Dagupan City" />
                            </label>
                            @error('location')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Deadline --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Deadline</span>
                            </label>
                            <label
                                class="input input-primary w-full {{ $errors->has('deadline') ? 'input-error' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-5">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                <input type="date"
                                    name="deadline"
                                    class="grow"
                                    value="{{ old('deadline') }}" />
                            </label>
                            @error('deadline')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Duration - Dynamic based on Job Type --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Duration</span>
                            </label>
                            <select name="duration"
                                class="select w-full {{ $errors->has('duration') ? 'select-error' : 'select-primary' }}">
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
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                            class="w-full btn btn-primary"
                            x-text="jobType === 'gig' ? 'Post Gig' : 'Post Contract'">
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
