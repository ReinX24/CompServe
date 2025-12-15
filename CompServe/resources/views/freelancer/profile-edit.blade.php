<x-layouts.app>
    <div class="max-w-5xl mx-auto mt-10 mb-10 px-4">
        <!-- Header Section with Gradient Background -->
        <div class="relative overflow-hidden bg-gradient-to-br from-primary/10 via-secondary/5 to-accent/10 rounded-2xl shadow-xl border border-base-300/50 mb-6">
            <!-- Decorative Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-0 left-0 w-40 h-40 bg-primary rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-60 h-60 bg-secondary rounded-full blur-3xl"></div>
            </div>

            <div class="relative p-6 md:p-8">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-primary to-primary/70 rounded-xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-content" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-base-content">
                            Edit Freelancer Profile
                        </h1>
                        <p class="text-base-content/70 mt-1">Update your professional information and showcase your experience</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="card bg-base-100 shadow-2xl">
            <div class="card-body p-6 md:p-8">
                <form action="{{ route('freelancer.profile.update') }}"
                    method="POST"
                    class="space-y-8"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo Section -->
                    <div x-data="{
                        preview: '{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : null }}'
                    }">
                        <div class="divider">
                            <span class="text-lg font-semibold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Profile Photo
                            </span>
                        </div>

                        <div class="flex flex-col items-center gap-6 p-6 bg-base-200/50 rounded-xl">
                            <!-- Avatar Preview -->
                            <div class="avatar indicator">
                                <span class="indicator-item indicator-bottom badge badge-primary badge-sm">Edit</span>
                                <div class="w-40 rounded-full ring ring-primary ring-offset-base-100 ring-offset-4 overflow-hidden shadow-2xl hover:ring-offset-6 transition-all">
                                    <template x-if="preview">
                                        <img :src="preview"
                                            class="w-full h-full object-cover"
                                            alt="Profile Photo" />
                                    </template>

                                    <template x-if="!preview">
                                        <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-primary to-secondary text-primary-content text-5xl font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- File Input -->
                            <div class="w-full max-w-md">
                                <label class="label">
                                    <span class="label-text font-semibold">Choose a new photo</span>
                                    <span class="label-text-alt text-base-content/60">JPG, PNG (Max 5MB)</span>
                                </label>
                                <input type="file"
                                    name="profile_photo"
                                    class="file-input file-input-bordered file-input-primary w-full"
                                    accept="image/*"
                                    @change="
                                        if (preview) URL.revokeObjectURL(preview);
                                        preview = URL.createObjectURL($event.target.files[0])
                                    " />
                            </div>
                        </div>
                    </div>

                    <!-- Basic Information Section -->
                    <div>
                        <div class="divider">
                            <span class="text-lg font-semibold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Basic Information
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span class="label-text font-semibold flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Full Name
                                    </span>
                                </label>
                                <input type="text"
                                    name="name"
                                    class="input input-bordered w-full focus:input-primary transition-all"
                                    placeholder="Enter your full name"
                                    value="{{ old('name', $user->name ?? '') }}">

                                @error('name')
                                    <div role="alert" class="alert alert-error shadow-lg mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Contact Number -->
                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span class="label-text font-semibold flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Contact Number
                                    </span>
                                </label>
                                <input type="text"
                                    name="contact_number"
                                    class="input input-bordered w-full focus:input-primary transition-all"
                                    placeholder="+1 (555) 000-0000"
                                    value="{{ old('contact_number', $freelancerInfo->contact_number ?? '') }}">
                            </div>

                            <!-- About Me -->
                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span class="label-text font-semibold flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                        </svg>
                                        About Me
                                    </span>
                                    <span class="label-text-alt text-base-content/60">Brief professional summary</span>
                                </label>
                                <textarea name="about_me"
                                    class="textarea textarea-bordered w-full h-28 focus:textarea-primary transition-all"
                                    placeholder="Describe your professional background, expertise, and what makes you unique...">{{ old('about_me', $freelancerInfo->about_me ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Section -->
                    <div x-data="skillsInput({{ json_encode(explode(',', old('skills', $freelancerInfo->skills ?? ''))) }})">
                        <div class="divider">
                            <span class="text-lg font-semibold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                                Professional Skills
                            </span>
                        </div>

                        <div class="bg-base-200/50 p-6 rounded-xl space-y-4">
                            <div class="flex gap-2">
                                <input type="text"
                                    x-model="newSkill"
                                    @keydown.enter.prevent="addSkill"
                                    placeholder="e.g., Web Development, Graphic Design..."
                                    class="input input-bordered flex-1 focus:input-primary transition-all">
                                <button type="button"
                                    @click="addSkill"
                                    class="btn btn-primary gap-2 hover:scale-105 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add
                                </button>
                            </div>

                            <input type="hidden" name="skills" :value="skills.join(',')">

                            <div class="flex flex-wrap gap-2">
                                <template x-for="(skill, index) in skills" :key="index">
                                    <div class="badge badge-primary badge-lg gap-2 p-4 hover:badge-secondary transition-colors">
                                        <span x-text="skill" class="font-medium"></span>
                                        <button type="button"
                                            @click="removeSkill(index)"
                                            class="hover:scale-110 transition-transform">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="skills.length === 0">
                                    <p class="text-base-content/60 text-sm">No skills added yet. Add your professional skills above.</p>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Experience Section -->
                    <div x-data="experiencesInput({{ json_encode(old('experiences', $freelancerInfo->experiences ?? [])) }})">
                        <div class="divider">
                            <span class="text-lg font-semibold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Work Experience
                            </span>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(exp, index) in experiences" :key="index">
                                <div class="card bg-base-200 border border-base-300 shadow-md hover:shadow-lg transition-shadow">
                                    <div class="card-body">
                                        <div class="flex justify-between items-start mb-4">
                                            <h3 class="card-title text-lg flex items-center gap-2">
                                                <span class="badge badge-primary" x-text="`#${index + 1}`"></span>
                                                Experience Entry
                                            </h3>
                                            <button type="button"
                                                @click="removeExperience(index)"
                                                class="btn btn-error btn-sm btn-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text font-semibold">Job Title</span>
                                                </label>
                                                <input type="text"
                                                    x-model="exp.job_title"
                                                    :name="`experiences[${index}][job_title]`"
                                                    placeholder="e.g., Senior Developer"
                                                    class="input input-bordered w-full focus:input-primary transition-all">
                                            </div>

                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text font-semibold">Company</span>
                                                </label>
                                                <input type="text"
                                                    x-model="exp.company"
                                                    :name="`experiences[${index}][company]`"
                                                    placeholder="e.g., Tech Corp Inc."
                                                    class="input input-bordered w-full focus:input-primary transition-all">
                                            </div>

                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text font-semibold">Start Date</span>
                                                </label>
                                                <input type="date"
                                                    x-model="exp.start_date"
                                                    :name="`experiences[${index}][start_date]`"
                                                    class="input input-bordered focus:input-primary transition-all">
                                            </div>

                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text font-semibold">End Date</span>
                                                </label>
                                                <input type="date"
                                                    x-model="exp.end_date"
                                                    :name="`experiences[${index}][end_date]`"
                                                    class="input input-bordered focus:input-primary transition-all">
                                            </div>

                                            <div class="form-control md:col-span-2">
                                                <label class="label">
                                                    <span class="label-text font-semibold">Description</span>
                                                </label>
                                                <textarea x-model="exp.description"
                                                    :name="`experiences[${index}][description]`"
                                                    placeholder="Describe your responsibilities, achievements, and key contributions..."
                                                    class="textarea textarea-bordered w-full h-24 focus:textarea-primary transition-all"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="experiences.length === 0">
                                <div class="alert alert-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>No work experience added yet. Click the button below to add your first entry.</span>
                                </div>
                            </template>

                            <button type="button"
                                @click="addExperience"
                                class="btn btn-outline btn-primary w-full gap-2 hover:scale-105 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Work Experience
                            </button>
                        </div>
                    </div>

                    <!-- Education Section -->
                    <div x-data="educationInput({{ json_encode(old('education', $freelancerInfo->education ?? [])) }})">
                        <div class="divider">
                            <span class="text-lg font-semibold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                                Education
                            </span>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(edu, index) in education" :key="index">
                                <div class="card bg-base-200 border border-base-300 shadow-md hover:shadow-lg transition-shadow">
                                    <div class="card-body">
                                        <div class="flex justify-between items-start mb-4">
                                            <h3 class="card-title text-lg flex items-center gap-2">
                                                <span class="badge badge-secondary" x-text="`#${index + 1}`"></span>
                                                Education Entry
                                            </h3>
                                            <button type="button"
                                                @click="removeEducation(index)"
                                                class="btn btn-error btn-sm btn-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="form-control md:col-span-2">
                                                <label class="label">
                                                    <span class="label-text font-semibold">School / University</span>
                                                </label>
                                                <input type="text"
                                                    x-model="edu.school"
                                                    :name="`education[${index}][school]`"
                                                    placeholder="e.g., Harvard University"
                                                    class="input input-bordered w-full focus:input-primary transition-all">
                                            </div>

                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text font-semibold">Degree / Qualification</span>
                                                </label>
                                                <input type="text"
                                                    x-model="edu.degree"
                                                    :name="`education[${index}][degree]`"
                                                    placeholder="e.g., Bachelor of Science"
                                                    class="input input-bordered w-full focus:input-primary transition-all">
                                            </div>

                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text font-semibold">Field of Study</span>
                                                </label>
                                                <input type="text"
                                                    x-model="edu.field_of_study"
                                                    :name="`education[${index}][field_of_study]`"
                                                    placeholder="e.g., Computer Science"
                                                    class="input input-bordered w-full focus:input-primary transition-all">
                                            </div>

                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text font-semibold">Start Year</span>
                                                </label>
                                                <input type="number"
                                                    x-model="edu.start_year"
                                                    :name="`education[${index}][start_year]`"
                                                    placeholder="2018"
                                                    min="1950"
                                                    max="2099"
                                                    class="input input-bordered focus:input-primary transition-all">
                                            </div>

                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text font-semibold">End Year</span>
                                                </label>
                                                <input type="number"
                                                    x-model="edu.end_year"
                                                    :name="`education[${index}][end_year]`"
                                                    placeholder="2022"
                                                    min="1950"
                                                    max="2099"
                                                    class="input input-bordered focus:input-primary transition-all">
                                            </div>

                                            <div class="form-control md:col-span-2">
                                                <label class="label">
                                                    <span class="label-text font-semibold">Awards & Achievements</span>
                                                </label>
                                                <textarea x-model="edu.awards"
                                                    :name="`education[${index}][awards]`"
                                                    placeholder="List any honors, awards, or notable achievements during your studies..."
                                                    class="textarea textarea-bordered w-full h-20 focus:textarea-primary transition-all"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="education.length === 0">
                                <div class="alert alert-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>No education entries added yet. Click the button below to add your first entry.</span>
                                </div>
                            </template>

                            <button type="button"
                                @click="addEducation"
                                class="btn btn-outline btn-secondary w-full gap-2 hover:scale-105 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Education
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="divider"></div>
                    <div class="flex flex-col-reverse sm:flex-row items-center justify-between gap-4 pt-4">
                        <a href="{{ route('freelancer.profile.show') }}"
                            class="btn btn-outline btn-error w-full sm:w-auto gap-2 hover:scale-105 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                        </a>
                        <button type="submit"
                            class="btn btn-success w-full sm:w-auto gap-2 hover:scale-105 transition-transform shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
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