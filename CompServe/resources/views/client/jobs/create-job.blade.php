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

            {{-- Auto-label based on whether this is gig or contract --}}
            <li class="text-primary font-semibold">
                {{ $jobType === 'gig'
                    ? 'Create Gig'
                    : ($jobType === 'contract'
                        ? 'Create Contract'
                        : 'Create Job') }}
            </li>
        </ul>
    </div>

    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-base-content">
            {{-- {{ __('Create a New Job') }} --}}
            {{ $jobType === 'gig'
                ? __('Create a New Gig')
                : ($jobType === 'contract'
                    ? __('Create a New Contract')
                    : __('Create a New Job')) }}
        </h1>
        <p class="text-base-content/70 mt-1">
            {{ __('Fill out the details to post a job.') }}
            {{ $jobType === 'gig'
                ? __('Fill out the details to post a gig.')
                : ($jobType === 'contract'
                    ? __('Fill out the details to post a contract.')
                    : __('Fill out the details to post a job.')) }}
        </p>
    </div>

    <div class="max-w-3xl mx-auto card bg-base-100 shadow-xl p-6">

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
                class="space-y-6">
                @csrf

                {{-- Job Title --}}
                <div class="form-control space-y-2">
                    <label class="label"><span class="label-text">Job
                            Title</span></label>
                    <input type="text"
                        name="title"
                        placeholder="Laptop Repair Specialist"
                        value="{{ old('title') }}"
                        class="input input-bordered w-full" />
                    @error('title')
                        <span
                            class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Job Description --}}
                <div class="form-control space-y-2">
                    <label class="label"><span
                            class="label-text">Description</span></label>
                    <textarea name="description"
                        rows="4"
                        placeholder="Provide job details..."
                        class="textarea textarea-bordered w-full">{{ old('description') }}</textarea>
                    @error('description')
                        <span
                            class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Job Type (Gig / Contract) - Dynamic --}}
                <div class="form-control space-y-2">
                    <label class="label"><span class="label-text">Job
                            Type</span></label>
                    <select name="duration_type"
                        x-model="jobType"
                        class="select select-bordered w-full">
                        <option value="gig">Gig</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>

                {{-- Category --}}
                <div class="form-control space-y-2">
                    <label class="label"><span
                            class="label-text">Category</span></label>
                    <select name="category"
                        class="select select-bordered w-full">
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
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Skills Required --}}
                <div x-data="{ skills: {{ json_encode(old('skills_required', [''])) }} }"
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

                {{-- Budget and Type --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control space-y-2">
                        <label class="label"><span class="label-text">Budget
                                Type</span></label>
                        <select name="budget_type"
                            class="select select-bordered w-full">
                            <option value="fixed"
                                {{ old('budget_type') == 'fixed' ? 'selected' : '' }}>
                                Fixed</option>
                            <option value="hourly"
                                {{ old('budget_type') == 'hourly' ? 'selected' : '' }}>
                                Hourly</option>
                        </select>
                    </div>

                    <div class="form-control space-y-2">
                        <label class="label"><span class="label-text">Budget
                                (₱)</span></label>
                        <input type="number"
                            name="budget"
                            value="{{ old('budget') }}"
                            class="input input-bordered w-full"
                            placeholder="150.00" />

                        @error('budget')
                            <span
                                class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                {{-- Location --}}
                <div class="form-control space-y-2">
                    <label class="label"><span
                            class="label-text">Location</span></label>
                    <input name="location"
                        value="{{ old('location') }}"
                        placeholder="Dagupan City"
                        class="input input-bordered w-full" />

                    @error('location')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Deadline --}}
                <div class="form-control space-y-2">
                    <label class="label"><span
                            class="label-text">Deadline</span></label>
                    <input type="date"
                        name="deadline"
                        value="{{ old('deadline') }}"
                        class="input input-bordered w-full" />

                    @error('deadline')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Duration - Dynamic based on Job Type --}}
                <div class="form-control w-full mb-4 space-y-2">
                    <label class="label"><span
                            class="label-text">Duration</span></label>

                    <select name="duration"
                        class="select select-bordered w-full">
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
                        <span
                            class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn btn-primary w-full">Post Job</button>
            </form>

        </div>
    </div>
</x-layouts.app>
