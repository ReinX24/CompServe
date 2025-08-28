<x-layouts.app>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Edit Freelancer Profile') }}
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            {{ __('Update your profile information below.') }}
        </p>
    </div>

    <div
        class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
        <!-- Form -->
        <form action="{{ route('freelancer.profile.update') }}"
            method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <x-forms.input label="Name"
                    name="name"
                    type="text"
                    placeholder="Enter your name"
                    value="{{ old('name', $user->name ?? '') }}" />
            </div>

            <!-- Contact Number -->
            <div class="mb-3">
                <x-forms.input label="Contact Number"
                    name="contact_number"
                    type="text"
                    placeholder="Enter your contact number"
                    value="{{ old('contact_number', $freelancerInfo->contact_number ?? '') }}" />
            </div>

            <!-- About Me -->
            <div class="mb-3">
                <x-forms.textarea label="About Me"
                    name="about_me"
                    placeholder="Write something about yourself"
                    class="h-24">{{ old('about_me', $freelancerInfo->about_me ?? '') }}</x-forms.textarea>
            </div>

            <!-- Skills Component -->
            <div class="mb-3"
                x-data="skillsInput({{ json_encode(explode(',', old('skills', $freelancerInfo->skills ?? ''))) }})">

                <x-forms.input label="Skills"
                    name="skill_temp"
                    type="text"
                    placeholder="Enter a skill"
                    x-model="newSkill" />

                <div class="mt-3">
                    <x-button type="success"
                        buttonType="button"
                        @click="addSkill">
                        Add Skill
                    </x-button>
                </div>

                <!-- Hidden field -->
                <input type="hidden"
                    name="skills"
                    :value="skills.join(',')">

                <!-- Skill List -->
                <ul class="mt-3 flex flex-wrap gap-2">
                    <template x-for="(skill, index) in skills"
                        :key="index">
                        <li
                            class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm flex items-center">
                            <span x-text="skill"></span>
                            <button type="button"
                                class="ml-2 text-red-600"
                                @click="removeSkill(index)">✕</button>
                        </li>
                    </template>
                </ul>
            </div>

            <!-- Experiences Component -->
            <div class="mb-3"
                x-data="experiencesInput({{ json_encode(old('experiences', $freelancerInfo->experiences ?? [])) }})">

                <h2
                    class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                    Experiences
                </h2>

                <template x-for="(exp, index) in experiences"
                    :key="index">
                    <div
                        class="p-4 mb-4 border rounded-lg bg-gray-50 dark:bg-gray-800">
                        <!-- Job Title -->
                        <label
                            class="block ml-1 font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Job Title
                        </label>
                        <input type="text"
                            x-model="exp.job_title"
                            :name="`experiences[${index}][job_title]`"
                            placeholder="e.g. Software Engineer"
                            class="w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300
                                   bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />

                        <!-- Company -->
                        <label
                            class="block ml-1 font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Company
                        </label>
                        <input type="text"
                            x-model="exp.company"
                            :name="`experiences[${index}][company]`"
                            placeholder="e.g. Google"
                            class="w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300
                                   bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />

                        <!-- Start Date -->
                        <label
                            class="block ml-1 font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Start Date
                        </label>
                        <input type="date"
                            x-model="exp.start_date"
                            :name="`experiences[${index}][start_date]`"
                            class="w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300
                                   bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />

                        <!-- End Date -->
                        <label
                            class="block ml-1 font-medium text-gray-700 dark:text-gray-300 mb-1">
                            End Date
                        </label>
                        <input type="date"
                            x-model="exp.end_date"
                            :name="`experiences[${index}][end_date]`"
                            class="w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300
                                   bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />

                        <!-- Description -->
                        <label
                            class="block ml-1 font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Description
                        </label>
                        <textarea x-model="exp.description"
                            :name="`experiences[${index}][description]`"
                            placeholder="Brief description of role"
                            class="w-full px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300
                                   bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </textarea>

                        <!-- Remove Button -->
                        <button type="button"
                            @click="removeExperience(index)"
                            class="mt-2 px-3 py-1 text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                            Remove
                        </button>
                    </div>
                </template>

                <!-- Add Experience -->
                <button type="button"
                    @click="addExperience"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    + Add Experience
                </button>
            </div>

            <!-- Submit -->
            <div class="mb-3">
                <x-button type="primary"
                    buttonType="submit"
                    class="w-full">
                    {{ __('Save Changes') }}
                </x-button>
            </div>

            <!-- Cancel -->
            <div>
                <x-button type="secondary"
                    buttonType="button"
                    class="w-full"
                    onclick="window.history.back()">
                    {{ __('Cancel') }}
                </x-button>
            </div>
        </form>
    </div>

    <script>
        // Skills Alpine component
        function skillsInput(initialSkills = []) {
            return {
                skills: initialSkills.filter(s => s.trim() !== ""),
                newSkill: "",
                addSkill() {
                    const skill = this.newSkill.trim();
                    if (skill && !this.skills.includes(skill)) {
                        this.skills.push(skill);
                    }
                    this.newSkill = "";
                },
                removeSkill(index) {
                    this.skills.splice(index, 1);
                }
            }
        }

        // Experiences Alpine component
        function experiencesInput(initialExperiences = []) {
            return {
                experiences: initialExperiences.length ? initialExperiences : [],
                addExperience() {
                    this.experiences.push({
                        job_title: "",
                        company: "",
                        start_date: "",
                        end_date: "",
                        description: ""
                    });
                },
                removeExperience(index) {
                    this.experiences.splice(index, 1);
                }
            }
        }
    </script>
</x-layouts.app>
