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

            <div class="mb-3">
                <x-forms.input label="Name"
                    name="name"
                    type="text"
                    placeholder="Enter your name"
                    value="{{ old('name', $user->name ?? '') }}" />
            </div>

            <div class="mb-3">
                <x-forms.input label="Contact Number"
                    name="contact_number"
                    type="text"
                    placeholder="Enter your contact number"
                    value="{{ old('contact_number', $freelancerInfo->contact_number ?? '') }}" />
            </div>

            <div class="mb-3">
                <x-forms.textarea label="About Me"
                    name="about_me"
                    placeholder="Write something about yourself"
                    class="h-24">{{ old('about_me', $freelancerInfo->about_me ?? '') }}</x-forms.textarea>
            </div>

            <!-- Skills Alpine.js Component -->
            <div class="mb-3"
                x-data="skillsInput({{ json_encode(explode(',', old('skills', $freelancerInfo->skills ?? ''))) }})">

                <!-- Label will be rendered by x-forms.input -->
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

                <!-- Hidden field for submission -->
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

            <div class="mb-3">
                {{-- Submit Button --}}
                <x-button type="primary"
                    buttonType="submit"
                    class="w-full">
                    {{ __('Save Changes') }}
                </x-button>
            </div>

            <div>
                {{-- Cancel Button --}}
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
    </script>

</x-layouts.app>
