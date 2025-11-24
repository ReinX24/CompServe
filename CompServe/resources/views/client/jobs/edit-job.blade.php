<x-layouts.app>
    {{-- Breadcrumbs (same as create page) --}}
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

    {{-- Header --}}
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-base-content">
            Edit {{ ucfirst($jobListing->duration_type) }}
        </h1>
        <p class="text-base-content/70 mt-1">
            Update the details of your {{ $jobListing->duration_type }}.
        </p>
    </div>

    <div class="max-w-3xl mx-auto card bg-base-100 shadow-xl p-6">

        {{-- Alpine.js Wrapper for Job Type + Duration --}}
        <div x-data="{
            jobType: '{{ old('duration_type', $jobListing->duration_type) }}',
            durations: {
                gig: ['1 day', '3 days', '5 days', '1 week', '1 month'],
                contract: ['1 day', '3 days', '5 days', '1 week', '1 month', '3 months', '6 months', '1 year']
            }
        }">

            <form action="{{ route('client.jobs.update', $jobListing->id) }}"
                method="POST"
                class="space-y-6">

                @csrf
                @method('PUT')

                {{-- Job Title --}}
                <div class="form-control space-y-2">
                    <label class="label"><span class="label-text">Job
                            Title</span></label>
                    <input type="text"
                        name="title"
                        value="{{ old('title', $jobListing->title) }}"
                        class="input input-bordered w-full" />
                    @error('title')
                        <span
                            class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="form-control space-y-2">
                    <label class="label"><span
                            class="label-text">Description</span></label>
                    <textarea name="description"
                        rows="4"
                        class="textarea textarea-bordered w-full">{{ old('description', $jobListing->description) }}</textarea>
                    @error('description')
                        <span
                            class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Job Type --}}
                <div class="form-control space-y-2">
                    <label class="label"><span class="label-text">Job
                            Type</span></label>
                    <select name="duration_type"
                        x-model="jobType"
                        class="select select-bordered w-full">
                        <option value="gig"
                            {{ old('duration_type', $jobListing->duration_type) === 'gig' ? 'selected' : '' }}>
                            Gig</option>
                        <option value="contract"
                            {{ old('duration_type', $jobListing->duration_type) === 'contract' ? 'selected' : '' }}>
                            Contract</option>
                    </select>
                </div>

                {{-- Category --}}
                <div class="form-control space-y-2">
                    <label class="label"><span
                            class="label-text">Category</span></label>
                    <select name="category"
                        class="select select-bordered w-full">
                        <option disabled>Select a category</option>

                        @foreach (['Hardware', 'DesktopComputers', 'LaptopComputers', 'MobilePhones', 'Accessories', 'Networking'] as $category)
                            <option value="{{ $category }}"
                                {{ old('category', $jobListing->category) == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach

                    </select>
                    @error('category')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Skills Required --}}
                <div x-data="{ skills: {{ json_encode(old('skills_required', $jobListing->skills_required ?? [''])) }} }"
                    class="space-y-2">
                    <label class="label"><span class="label-text">Skills
                            Required</span></label>

                    <template x-for="(skill, index) in skills"
                        :key="index">
                        <div class="flex gap-2">
                            <input class="input input-bordered w-full"
                                type="text"
                                x-model="skills[index]"
                                :name="'skills_required[' + index + ']'"
                                placeholder="Enter a skill" />
                            <button type="button"
                                @click="skills.splice(index, 1)"
                                class="btn btn-error">✕</button>
                        </div>
                    </template>

                    <button type="button"
                        @click="skills.push('')"
                        class="btn btn-success btn-sm">+ Add Skill</button>

                    @error('skills_required')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Budget and Budget Type --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control space-y-2">
                        <label class="label"><span class="label-text">Budget
                                Type</span></label>
                        <select name="budget_type"
                            class="select select-bordered w-full">
                            <option value="fixed"
                                {{ old('budget_type', $jobListing->budget_type) == 'fixed' ? 'selected' : '' }}>
                                Fixed</option>
                            <option value="hourly"
                                {{ old('budget_type', $jobListing->budget_type) == 'hourly' ? 'selected' : '' }}>
                                Hourly</option>
                        </select>
                    </div>

                    <div class="form-control space-y-2">
                        <label class="label"><span class="label-text">Budget
                                (₱)</span></label>
                        <input type="number"
                            name="budget"
                            value="{{ old('budget', $jobListing->budget) }}"
                            class="input input-bordered w-full" />
                    </div>
                </div>

                {{-- Location --}}
                <div class="form-control space-y-2">
                    <label class="label"><span
                            class="label-text">Location</span></label>
                    <input name="location"
                        value="{{ old('location', $jobListing->location) }}"
                        class="input input-bordered w-full" />
                </div>

                {{-- Deadline --}}
                <div class="form-control space-y-2">
                    <label class="label"><span
                            class="label-text">Deadline</span></label>
                    <input type="date"
                        name="deadline"
                        value="{{ old('deadline', $jobListing->deadline ? $jobListing->deadline->format('Y-m-d') : '') }}"
                        class="input input-bordered w-full" />
                </div>

                {{-- Duration (Dynamic like Create Page) --}}
                <div class="form-control w-full mb-4 space-y-2">
                    <label class="label"><span
                            class="label-text">Duration</span></label>

                    <select name="duration"
                        class="select select-bordered w-full">

                        <template x-for="d in durations[jobType]"
                            :key="d">
                            <option :value="d"
                                x-text="d"
                                :selected="d === '{{ old('duration', $jobListing->duration) }}'">
                            </option>
                        </template>

                    </select>
                </div>

                <button class="btn btn-primary w-full"
                    x-text="jobType === 'gig' ? 'Update Gig' : 'Update Contract'"></button>
            </form>

            {{-- Delete Job --}}
            <form action="{{ route('client.jobs.destroy', $jobListing->id) }}"
                method="POST"
                class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="btn btn-outline btn-error w-full"
                    onclick="return confirm('Are you sure you want to delete this job listing? This action cannot be undone.')">
                    Delete Job
                </button>
            </form>

        </div>
    </div>

</x-layouts.app>
