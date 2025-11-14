<x-layouts.app>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-base-content">
            {{ __('Edit Job Listing') }}</h1>
        <p class="text-base-content/70 mt-1">
            {{ __('Update the details of your job listing.') }}</p>
    </div>

    <div class="max-w-3xl mx-auto card bg-base-100 shadow-xl p-6">
        <form action="{{ route('client.jobs.update', $jobListing->id) }}"
            method="POST"
            class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Job Title --}}
            <div class="form-control">
                <label class="label"><span class="label-text">Job
                        Title</span></label>
                <input type="text"
                    name="title"
                    placeholder="Laptop Repair Specialist"
                    value="{{ old('title', $jobListing->title) }}"
                    class="input input-bordered w-full" />
                @error('title')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Job Description --}}
            <div class="form-control">
                <label class="label"><span
                        class="label-text">Description</span></label>
                <textarea name="description"
                    rows="4"
                    placeholder="Provide job details..."
                    class="textarea textarea-bordered w-full">{{ old('description', $jobListing->description) }}</textarea>
                @error('description')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Job Type (Gig / Contract) --}}
            <div class="form-control">
                <label class="label"><span class="label-text">Job
                        Type</span></label>
                <select name="duration_type"
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
            <div class="form-control">
                <label class="label"><span
                        class="label-text">Category</span></label>
                <select name="category"
                    class="select select-bordered w-full">
                    <option disabled>Select a category</option>
                    <option value="Hardware"
                        {{ old('category', $jobListing->category) == 'Hardware' ? 'selected' : '' }}>
                        Hardware
                    </option>
                    <option value="DesktopComputers"
                        {{ old('category', $jobListing->category) == 'DesktopComputers' ? 'selected' : '' }}>
                        Desktop Computers</option>
                    <option value="LaptopComputers"
                        {{ old('category', $jobListing->category) == 'LaptopComputers' ? 'selected' : '' }}>
                        Laptop Computers</option>
                    <option value="MobilePhones"
                        {{ old('category', $jobListing->category) == 'MobilePhones' ? 'selected' : '' }}>
                        Mobile Phones</option>
                    <option value="Accessories"
                        {{ old('category', $jobListing->category) == 'Accessories' ? 'selected' : '' }}>
                        Computer Accessories</option>
                    <option value="Networking"
                        {{ old('category', $jobListing->category) == 'Networking' ? 'selected' : '' }}>
                        Networking</option>
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

            {{-- Budget and Type --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="form-control">
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
                <div class="form-control">
                    <label class="label"><span class="label-text">Budget
                            (₱)</span></label>
                    <input type="number"
                        name="budget"
                        value="{{ old('budget', $jobListing->budget) }}"
                        class="input input-bordered w-full"
                        placeholder="150.00" />
                </div>
            </div>

            {{-- Location --}}
            <div class="form-control">
                <label class="label"><span
                        class="label-text">Location</span></label>
                <input name="location"
                    value="{{ old('location', $jobListing->location) }}"
                    placeholder="Dagupan City"
                    class="input input-bordered w-full" />
            </div>

            {{-- Deadline --}}
            <div class="form-control">
                <label class="label"><span
                        class="label-text">Deadline</span></label>
                <input type="date"
                    name="deadline"
                    value="{{ old('deadline', $jobListing->deadline ? $jobListing->deadline->format('Y-m-d') : '') }}"
                    class="input input-bordered w-full" />
            </div>

            <button class="btn btn-primary w-full">Update Job</button>
        </form>

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
</x-layouts.app>
