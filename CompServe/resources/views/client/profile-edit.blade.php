<x-layouts.app>
    <div class="max-w-4xl mx-auto mt-10 mb-10 px-4">
        <!-- Header Section with Gradient Background -->
        <div
            class="relative overflow-hidden bg-linear-to-br from-primary/10 via-secondary/5 to-accent/10 rounded-2xl shadow-xl border border-base-300/50 mb-6">
            <!-- Decorative Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div
                    class="absolute top-0 left-0 w-40 h-40 bg-primary rounded-full blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-60 h-60 bg-secondary rounded-full blur-3xl">
                </div>
            </div>

            <div class="relative p-6 md:p-8">
                <div class="flex items-center gap-4">
                    <div
                        class="p-3 bg-linear-to-br from-primary to-primary/70 rounded-xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-primary-content"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2
                            class="text-3xl md:text-4xl font-bold text-base-content">
                            Edit Your Profile
                        </h2>
                        <p class="text-base-content/70 mt-1">Update your
                            personal information and social links</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="card bg-base-100 shadow-2xl">
            <div class="card-body p-6 md:p-8">
                <form action="{{ route('client.profile.update') }}"
                    method="POST"
                    class="space-y-8"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo Section -->
                    <div x-data="{
                        preview: '{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : null }}',

                        updatePreview(event) {
                            const files = event.target.files;

                            if (!files || !files.length) return;

                            if (this.preview && this.preview.startsWith('blob:')) {
                                URL.revokeObjectURL(this.preview);
                            }

                            this.preview = URL.createObjectURL(files[0]);
                        }
                    }">
                        <div class="divider">
                            <span
                                class="text-lg font-semibold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Profile Photo
                            </span>
                        </div>

                        <div
                            class="flex flex-col items-center gap-6 p-6 bg-base-200/50 rounded-xl">
                            <!-- Avatar Preview -->
                            <div class="avatar indicator">
                                <span
                                    class="indicator-item indicator-bottom badge badge-primary badge-sm">Edit</span>
                                <div
                                    class="w-40 rounded-full ring ring-primary ring-offset-base-100 ring-offset-4 overflow-hidden shadow-2xl hover:ring-offset-6 transition-all">
                                    <template x-if="preview">
                                        <img :src="preview"
                                            class="w-full h-full object-cover"
                                            alt="Profile Photo" />
                                    </template>

                                    <template x-if="!preview">
                                        <div
                                            class="flex items-center justify-center w-full h-full bg-linear-to-br from-primary to-secondary text-primary-content text-5xl font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- File Input with Enhanced Styling -->
                            <div class="w-full max-w-md">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold">Choose
                                        a new photo</span>
                                    <span
                                        class="label-text-alt text-base-content/60">JPG,
                                        PNG (Max 5MB)</span>
                                </label>
                                <input type="file"
                                    name="profile_photo"
                                    class="file-input file-input-bordered file-input-primary w-full"
                                    accept="image/*"
                                    @change="updatePreview($event)" />
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information Section -->
                    <div>
                        <div class="divider">
                            <span
                                class="text-lg font-semibold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Full Name
                                    </span>
                                </label>
                                <input type="text"
                                    name="name"
                                    class="input input-bordered w-full focus:input-primary transition-all"
                                    placeholder="Enter your full name"
                                    value="{{ old('name', Auth::user()->name ?? '') }}">
                            </div>

                            <!-- Contact Number -->
                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Contact Number
                                    </span>
                                </label>
                                <input type="text"
                                    name="contact_number"
                                    class="input input-bordered w-full focus:input-primary transition-all"
                                    placeholder="+1 (555) 000-0000"
                                    value="{{ old('contact_number', $profile->contact_number ?? '') }}" />
                            </div>

                            <!-- About Me -->
                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h7" />
                                        </svg>
                                        About Me
                                    </span>
                                    <span
                                        class="label-text-alt text-base-content/60">Tell
                                        us about yourself</span>
                                </label>
                                <textarea name="about_me"
                                    class="textarea textarea-bordered w-full h-32 focus:textarea-primary transition-all"
                                    placeholder="Write a brief description about yourself, your interests, and what makes you unique...">{{ old('about_me', $profile->about_me ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links Section -->
                    <div>
                        <div class="divider">
                            <span
                                class="text-lg font-semibold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                                Social Media Links
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Facebook -->
                            <div class="form-control">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold flex items-center gap-2">
                                        <svg class="h-4 w-4 text-[#1877F2]"
                                            fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                        Facebook
                                    </span>
                                </label>
                                <input type="text"
                                    name="facebook"
                                    class="input input-bordered w-full focus:input-primary transition-all"
                                    placeholder="https://facebook.com/yourprofile"
                                    value="{{ old('facebook', $profile->facebook ?? '') }}" />
                            </div>

                            <!-- Instagram -->
                            <div class="form-control">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold flex items-center gap-2">
                                        <svg class="h-4 w-4 text-[#E4405F]"
                                            fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                        Instagram
                                    </span>
                                </label>
                                <input type="text"
                                    name="instagram"
                                    class="input input-bordered w-full focus:input-primary transition-all"
                                    placeholder="https://instagram.com/yourprofile"
                                    value="{{ old('instagram', $profile->instagram ?? '') }}" />
                            </div>

                            <!-- LinkedIn -->
                            <div class="form-control">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold flex items-center gap-2">
                                        <svg class="h-4 w-4 text-[#0077B5]"
                                            fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                        </svg>
                                        LinkedIn
                                    </span>
                                </label>
                                <input type="text"
                                    name="linkedin"
                                    class="input input-bordered w-full focus:input-primary transition-all"
                                    placeholder="https://linkedin.com/in/yourprofile"
                                    value="{{ old('linkedin', $profile->linkedin ?? '') }}" />
                            </div>

                            <!-- Twitter / X -->
                            <div class="form-control">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold flex items-center gap-2">
                                        <svg class="h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                        </svg>
                                        Twitter / X
                                    </span>
                                </label>
                                <input type="text"
                                    name="twitter"
                                    class="input input-bordered w-full focus:input-primary transition-all"
                                    placeholder="https://x.com/yourprofile"
                                    value="{{ old('twitter', $profile->twitter ?? '') }}" />
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="divider"></div>
                    <div
                        class="flex flex-col-reverse sm:flex-row items-center justify-between gap-4 pt-4">
                        <a href="{{ route('client.profile.show') }}"
                            class="btn btn-outline btn-error w-full sm:w-auto gap-2 hover:scale-105 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                        </a>
                        <button type="submit"
                            class="btn btn-primary w-full sm:w-auto gap-2 hover:scale-105 transition-transform shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
