<x-layouts.app>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Edit Job') }}
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            {{ __('Update the details below to edit your job posting.') }}
        </p>
    </div>

    <div
        class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
        <form action="{{ route('client.jobs.update', $jobListing->id) }}"
            method="POST"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Job Title -->
            <div>
                <label for="title"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Job Title') }}
                </label>
                <input type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $jobListing->title) }}"
                    required
                    placeholder="e.g. Laptop Repair Specialist"
                    class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
                           bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Job Description -->
            <div>
                <label for="description"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Description') }}
                </label>
                <textarea name="description"
                    id="description"
                    rows="4"
                    required
                    placeholder="Provide details about the job..."
                    class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
                           bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('description', $jobListing->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Category') }}
                </label>
                <select name="category"
                    id="category"
                    required
                    class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
               bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value=""
                        disabled>Select a category</option>
                    <option value="Hardware"
                        {{ old('category', $jobListing->category) == 'Hardware' ? 'selected' : '' }}>
                        Hardware</option>
                    <option value="Software"
                        {{ old('category', $jobListing->category) == 'Software' ? 'selected' : '' }}>
                        Software</option>
                    <option value="Networking"
                        {{ old('category', $jobListing->category) == 'Networking' ? 'selected' : '' }}>
                        Networking</option>
                </select>
                @error('category')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Skills Required -->
            <div x-data="{ skills: {{ json_encode(old('skills_required', $jobListing->skills_required ?? [])) }} }"
                class="space-y-2">
                <label for="skills_required"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Skills Required') }}
                </label>

                <!-- List of skills -->
                <template x-for="(skill, index) in skills"
                    :key="index">
                    <div class="flex items-stretch space-x-2">
                        <input type="text"
                            :name="'skills_required[' + index + ']'"
                            x-model="skills[index]"
                            placeholder="Enter a skill"
                            class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
               bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">

                        <button type="button"
                            @click="skills.splice(index, 1)"
                            class="px-3 bg-red-500 text-white rounded-lg hover:bg-red-600 flex items-center justify-center">
                            ✕
                        </button>
                    </div>
                </template>

                <!-- Add Skill Button -->
                <button type="button"
                    @click="skills.push('')"
                    class="mt-2 px-4 py-2 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600">
                    + Add Skill
                </button>

                @error('skills_required')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Budget Type -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Budget Type -->
                <div>
                    <label for="budget_type"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ __('Budget Type') }}
                    </label>
                    <select name="budget_type"
                        id="budget_type"
                        required
                        class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
                   bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="fixed"
                            {{ old('budget_type', $jobListing->budget_type) == 'fixed' ? 'selected' : '' }}>
                            Fixed</option>
                        <option value="hourly"
                            {{ old('budget_type', $jobListing->budget_type) == 'hourly' ? 'selected' : '' }}>
                            Hourly</option>
                    </select>
                </div>

                <!-- Budget -->
                <div>
                    <label for="budget"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ __('Budget (₱)') }}
                    </label>
                    <input type="number"
                        step="0.01"
                        name="budget"
                        id="budget"
                        value="{{ old('budget', $jobListing->budget) }}"
                        placeholder="e.g. 150.00"
                        class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
                   bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
            </div>

            <!-- Location -->
            <div>
                <label for="location"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Location') }}
                </label>
                <input type="text"
                    name="location"
                    id="location"
                    value="{{ old('location', $jobListing->location) }}"
                    placeholder="Dagupan City, Pangasinan"
                    class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
                           bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deadline -->
            <div>
                <label for="deadline"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Deadline') }}
                </label>
                <input type="date"
                    name="deadline"
                    id="deadline"
                    value="{{ old('deadline', $jobListing->deadline ? $jobListing->deadline->format('Y-m-d') : '') }}"
                    class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
                           bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('deadline')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit + Cancel -->
            <div class="flex items-center justify-between space-x-4">
                <x-button type="primary"
                    buttonType="submit"
                    class="flex-1">
                    {{ __('Update Job') }}
                </x-button>

                <x-button type="secondary"
                    buttonType="button"
                    class="flex-1"
                    onclick="window.history.back()">
                    {{ __('Cancel') }}
                </x-button>
            </div>
        </form>

        <!-- Delete Job -->
        <form action="{{ route('client.jobs.destroy', $jobListing->id) }}"
            method="POST"
            class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit"
                onclick="return confirm('Are you sure you want to delete this job? This action cannot be undone.')"
                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                {{ __('Delete Job') }}
            </button>
        </form>
    </div>
</x-layouts.app>
