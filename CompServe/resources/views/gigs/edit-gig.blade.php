<x-layouts.app>
    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm mb-4">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>

            <li>
                <a
                    href="{{ $jobListing->duration_type === 'gig'
                        ? route('client.gigs.index')
                        : ($jobListing->duration_type === 'contract'
                            ? route('client.contracts.index')
                            : route('client.gigs.index')) }}">
                    {{ $jobListing->duration_type === 'gig'
                        ? __('All Gigs')
                        : ($jobListing->duration_type === 'contract'
                            ? __('All Contracts')
                            : __('All Jobs')) }}
                </a>
            </li>

            <li class="text-primary font-semibold">
                Edit {{ ucfirst($jobListing->duration_type) }}
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
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-base-content">
                Edit {{ ucfirst($jobListing->duration_type) }}
            </h1>
            <p class="text-base-content/70 mt-1">
                Update the details of your {{ $jobListing->duration_type }}.
            </p>
        </div>

        {{-- Form Card --}}
        <div class="rounded-lg shadow-md border overflow-hidden border-primary">
            <div class="p-6">

                {{-- Alpine.js Wrapper for Job Type + Duration --}}
                <div x-data="{
                    jobType: '{{ old('duration_type', $jobListing->duration_type) }}',
                    durations: {
                        gig: ['1 day', '3 days', '5 days', '1 week', '1 month'],
                        contract: ['1 day', '3 days', '5 days', '1 week', '1 month', '3 months', '6 months', '1 year']
                    }
                }">

                    <form
                        action="{{ route('client.jobs.update', $jobListing->id) }}"
                        method="POST"
                        class="space-y-4">

                        @csrf
                        @method('PUT')

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
                                    value="{{ old('title', $jobListing->title) }}" />
                            </label>
                            @error('title')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Description</span>
                            </label>
                            <textarea name="description"
                                rows="4"
                                class="textarea w-full {{ $errors->has('description') ? 'textarea-error' : 'textarea-primary' }}">{{ old('description', $jobListing->description) }}</textarea>
                            @error('description')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Job Type --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Job Type</span>
                            </label>
                            <select name="duration_type"
                                x-model="jobType"
                                class="select w-full {{ $errors->has('duration_type') ? 'select-error' : 'select-primary' }}">
                                <option value="gig"
                                    {{ old('duration_type', $jobListing->duration_type) === 'gig' ? 'selected' : '' }}>
                                    Gig</option>
                                <option value="contract"
                                    {{ old('duration_type', $jobListing->duration_type) === 'contract' ? 'selected' : '' }}>
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
                                <option disabled>Select a category</option>

                                @foreach (['Hardware', 'DesktopComputers', 'LaptopComputers', 'MobilePhones', 'Accessories', 'Networking'] as $category)
                                    <option value="{{ $category }}"
                                        {{ old('category', $jobListing->category) == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach

                            </select>
                            @error('category')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Skills Required --}}
                        <div x-data="{ skills: {{ json_encode(old('skills_required', $jobListing->skills_required ?? [''])) }} }"
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

                        {{-- Budget and Budget Type --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-medium text-base-content">
                                    <span>Budget Type</span>
                                </label>
                                <select name="budget_type"
                                    class="select w-full {{ $errors->has('budget_type') ? 'select-error' : 'select-primary' }}">
                                    <option value="fixed"
                                        {{ old('budget_type', $jobListing->budget_type) == 'fixed' ? 'selected' : '' }}>
                                        Fixed</option>
                                    <option value="hourly"
                                        {{ old('budget_type', $jobListing->budget_type) == 'hourly' ? 'selected' : '' }}>
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
                                        value="{{ old('budget', $jobListing->budget) }}" />
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
                                    value="{{ old('location', $jobListing->location) }}" />
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
                                class="input w-full {{ $errors->has('deadline') ? 'input-error' : 'input-primary' }}">
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
                                    value="{{ old('deadline', $jobListing->deadline ? $jobListing->deadline->format('Y-m-d') : '') }}" />
                            </label>
                            @error('deadline')
                                <div role="alert"
                                    class="alert alert-error alert-soft mt-2">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Duration (Dynamic like Create Page) --}}
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium text-base-content">
                                <span>Duration</span>
                            </label>
                            <select name="duration"
                                class="select w-full {{ $errors->has('duration') ? 'select-error' : 'select-primary' }}">

                                <template x-for="d in durations[jobType]"
                                    :key="d">
                                    <option :value="d"
                                        x-text="d"
                                        :selected="d === '{{ old('duration', $jobListing->duration) }}'">
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

                        {{-- Update Button --}}
                        <button type="submit"
                            class="w-full btn btn-primary"
                            x-text="jobType === 'gig' ? 'Update Gig' : 'Update Contract'">
                        </button>
                    </form>

                    {{-- Delete Job --}}
                    <form
                        action="{{ route('client.jobs.destroy', $jobListing->id) }}"
                        method="POST"
                        class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-outline btn-error w-full"
                            onclick="return confirm('Are you sure you want to delete this job listing? This action cannot be undone.')">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Delete Job
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
