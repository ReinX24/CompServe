<x-layouts.app>
    <div class="max-w-4xl mx-auto bg-base-100 shadow-lg rounded-2xl p-8">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-primary">Edit Freelancer Profile
            </h1>
            <p class="text-base-content/70 mt-2">
                Update your professional information and showcase your
                experience.
            </p>
        </div>

        <form action="{{ route('freelancer.profile.update') }}"
            method="POST"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="form-control">
                <label class="label font-semibold">Name</label>
                <input type="text"
                    name="name"
                    class="input input-bordered w-full"
                    placeholder="Enter your name"
                    value="{{ old('name', $user->name ?? '') }}">
            </div>

            <!-- Contact Number -->
            <div class="form-control">
                <label class="label font-semibold">Contact Number</label>
                <input type="text"
                    name="contact_number"
                    class="input input-bordered w-full"
                    placeholder="Enter your contact number"
                    value="{{ old('contact_number', $freelancerInfo->contact_number ?? '') }}">
            </div>

            <!-- About Me -->
            <div class="form-control">
                <label class="label font-semibold">About Me</label>
                <textarea name="about_me"
                    class="textarea textarea-bordered w-full h-28"
                    placeholder="Write something about yourself">{{ old('about_me', $freelancerInfo->about_me ?? '') }}</textarea>
            </div>

            <!-- Skills Section -->
            <div x-data="skillsInput({{ json_encode(explode(',', old('skills', $freelancerInfo->skills ?? ''))) }})"
                class="form-control">
                <label class="label font-semibold">Skills</label>
                <div class="flex gap-2">
                    <input type="text"
                        x-model="newSkill"
                        placeholder="Enter a skill"
                        class="input input-bordered flex-1">
                    <button type="button"
                        @click="addSkill"
                        class="btn btn-primary">Add</button>
                </div>

                <input type="hidden"
                    name="skills"
                    :value="skills.join(',')">

                <div class="flex flex-wrap gap-2 mt-3">
                    <template x-for="(skill, index) in skills"
                        :key="index">
                        <div class="badge badge-primary gap-2 p-3">
                            <span x-text="skill"></span>
                            <button type="button"
                                @click="removeSkill(index)"
                                class="text-error">✕</button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Experiences Section -->
            <div x-data="experiencesInput({{ json_encode(old('experiences', $freelancerInfo->experiences ?? [])) }})"
                class="form-control">
                <label class="label font-semibold text-lg">Experiences</label>

                <template x-for="(exp, index) in experiences"
                    :key="index">
                    <div
                        class="card bg-base-200 p-4 mb-3 border border-base-300 rounded-xl">
                        <div class="grid gap-3">
                            <input type="text"
                                x-model="exp.job_title"
                                :name="`experiences[${index}][job_title]`"
                                placeholder="Job Title"
                                class="input input-bordered w-full">

                            <input type="text"
                                x-model="exp.company"
                                :name="`experiences[${index}][company]`"
                                placeholder="Company"
                                class="input input-bordered w-full">

                            <div class="grid grid-cols-2 gap-3">
                                <input type="date"
                                    x-model="exp.start_date"
                                    :name="`experiences[${index}][start_date]`"
                                    class="input input-bordered">
                                <input type="date"
                                    x-model="exp.end_date"
                                    :name="`experiences[${index}][end_date]`"
                                    class="input input-bordered">
                            </div>

                            <textarea x-model="exp.description"
                                :name="`experiences[${index}][description]`"
                                placeholder="Brief description of role"
                                class="textarea textarea-bordered w-full h-24"></textarea>

                            <button type="button"
                                @click="removeExperience(index)"
                                class="btn btn-error btn-sm mt-2">Remove</button>
                        </div>
                    </div>
                </template>

                <button type="button"
                    @click="addExperience"
                    class="btn btn-primary w-full">+ Add Experience</button>
            </div>

            <!-- Education Section -->
            <div x-data="educationInput({{ json_encode(old('education', $freelancerInfo->education ?? [])) }})"
                class="form-control">
                <label class="label font-semibold text-lg">Education</label>

                <template x-for="(edu, index) in education"
                    :key="index">
                    <div
                        class="card bg-base-200 p-4 mb-3 border border-base-300 rounded-xl">
                        <div class="grid gap-3">
                            <input type="text"
                                x-model="edu.school"
                                :name="`education[${index}][school]`"
                                placeholder="School / University"
                                class="input input-bordered w-full">

                            <input type="text"
                                x-model="edu.degree"
                                :name="`education[${index}][degree]`"
                                placeholder="Degree / Qualification"
                                class="input input-bordered w-full">

                            <input type="text"
                                x-model="edu.field_of_study"
                                :name="`education[${index}][field_of_study]`"
                                placeholder="Field of Study"
                                class="input input-bordered w-full">

                            <div class="grid grid-cols-2 gap-3">
                                <input type="number"
                                    x-model="edu.start_year"
                                    :name="`education[${index}][start_year]`"
                                    placeholder="Start Year"
                                    class="input input-bordered">
                                <input type="number"
                                    x-model="edu.end_year"
                                    :name="`education[${index}][end_year]`"
                                    placeholder="End Year"
                                    class="input input-bordered">
                            </div>

                            <textarea x-model="edu.awards"
                                :name="`education[${index}][awards]`"
                                placeholder="Awards, honors, or achievements"
                                class="textarea textarea-bordered w-full h-20"></textarea>

                            <button type="button"
                                @click="removeEducation(index)"
                                class="btn btn-error btn-sm mt-2">Remove</button>
                        </div>
                    </div>
                </template>

                <button type="button"
                    @click="addEducation"
                    class="btn btn-primary w-full">+ Add Education</button>
            </div>

            <!-- Actions -->
            <div class="flex flex-col gap-3 mt-6">
                <button type="submit"
                    class="btn btn-success w-full">
                    Save Changes
                </button>
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

        function educationInput(initialEducation = []) {
            return {
                education: initialEducation.length ? initialEducation : [],
                addEducation() {
                    this.education.push({
                        school: "",
                        degree: "",
                        field_of_study: "",
                        start_year: "",
                        end_year: "",
                        awards: ""
                    });
                },
                removeEducation(index) {
                    this.education.splice(index, 1);
                }
            }
        }
    </script>
</x-layouts.app>
