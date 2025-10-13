<x-layouts.app>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Create a New Job') }}
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            {{ __('Fill out the details below to post a new job.') }}
        </p>
    </div>

    <div
        class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
        <form action="{{ route('client.jobs.store') }}"
            method="POST"
            class="space-y-6">
            @csrf

            {{-- Job Title --}}
            <div>
                <label for="title"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Job Title') }}
                </label>
                <input type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    placeholder="e.g. Laptop Repair Specialist"
                    class="input w-full {{ $errors->has('title') ? 'input-error' : 'input-primary' }}">

                @error('title')
                    <div role="alert"
                        class="alert alert-error alert-soft mt-3">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Job Description --}}
            <div>
                <label for="description"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Description') }}
                </label>
                <textarea name="description"
                    id="description"
                    rows="4"
                    placeholder="Provide details about the job..."
                    class="textarea w-full
                    {{ $errors->has('description') ? 'textarea-error' : 'textarea-primary' }}
                    ">{{ old('description') }}</textarea>
                @error('description')
                    <div role="alert"
                        class="alert alert-error alert-soft mt-3">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Category') }}
                </label>
                <select name="category"
                    id="category"
                    class="select w-full
                    {{ $errors->has('category') ? 'select-error' : 'select-primary' }}
                    ">
                    <option value=""
                        disabled
                        selected>Select a category</option>
                    <option value="Hardware"
                        {{ old('category') == 'Hardware' ? 'selected' : '' }}>
                        Hardware</option>
                    <option value="DesktopComputers"
                        {{ old('category') == 'DesktopComputers' ? 'selected' : '' }}>
                        Desktop Computers</option>
                    <option value="Laptop Computers"
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
                        class="alert alert-error alert-soft mt-3">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Skills Required --}}
            <div x-data="{
                skills: {{ json_encode(old('skills_required', [''])) }}
            }"
                class="space-y-2">
                <label for="skills_required"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Skills Required') }}
                </label>

                {{-- List of skills --}}
                <template x-for="(skill, index) in skills"
                    :key="index">
                    <div class="flex items-stretch space-x-2">
                        <input type="text"
                            :name="'skills_required[' + index + ']'"
                            x-model="skills[index]"
                            placeholder="Enter a skill"
                            class="input w-full
                    {{ $errors->has('skills_required') ? 'input-error' : 'input-primary' }}">

                        <button type="button"
                            @click="skills.splice(index, 1)"
                            class="px-3 btn btn-error items-center justify-center">
                            ✕
                        </button>
                    </div>
                </template>

                <!-- Add Skill Button -->
                <div class="flex">
                    <button type="button"
                        @click="skills.push('')"
                        class="mt-2 px-4 py-2 flex-1 btn btn-success">
                        + Add Skill
                    </button>
                </div>

                @error('skills_required')
                    <div role="alert"
                        class="alert alert-error alert-soft mt-3">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Budget type and amount --}}
            <div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="budget_type"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Budget Type') }}
                        </label>
                        <select name="budget_type"
                            id="budget_type"
                            required
                            class="select w-full input-primary">
                            <option value="fixed"
                                {{ old('budget_type') == 'fixed' ? 'selected' : '' }}>
                                Fixed</option>
                            <option value="hourly"
                                {{ old('budget_type') == 'hourly' ? 'selected' : '' }}>
                                Hourly</option>
                        </select>
                    </div>

                    <div>
                        <label for="budget"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Budget (₱)') }}
                        </label>
                        <input type="number"
                            step="0.01"
                            name="budget"
                            id="budget"
                            value="{{ old('budget') }}"
                            placeholder="e.g. 150.00"
                            class="input w-full
                        {{ $errors->has('budget') ? 'input-error' : 'input-primary' }}
                        ">
                    </div>
                </div>

                @error('budget')
                    <div role="alert"
                        class="alert alert-error alert-soft mt-3">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
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
                    value="{{ old('location') }}"
                    placeholder="Dagupan City, Pangasinan"
                    class="input w-full
                        {{ $errors->has('budget') ? 'input-error' : 'input-primary' }}">
                @error('location')
                    <div role="alert"
                        class="alert alert-error alert-soft mt-3 w-full">
                        <span>{{ $message }}</span>
                    </div>
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
                    value="{{ old('deadline') }}"
                    class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
                           bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('deadline')
                    <div role="alert"
                        class="alert alert-error alert-soft mt-3 w-full">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="flex items-center justify-between space-x-4">
                <button type="submit"
                    class="flex-1 btn btn-primary">{{ __('Post Job') }}</button>
            </div>
        </form>
    </div>
</x-layouts.app>
