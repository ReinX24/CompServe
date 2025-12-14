<x-layouts.app>
    <div class="max-w-3xl mx-auto mt-10 card bg-base-100 shadow-xl p-8">
        <h2 class="text-3xl font-bold mb-6 text-primary text-center">
            Edit Client Profile
        </h2>

        <form action="{{ route('client.profile.update') }}"
            method="POST"
            class="space-y-6"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Photo -->
            <div class="flex flex-col items-center justify-center gap-6">
                <!-- Avatar Preview -->
                <div class="avatar">
                    <div
                        class="w-32 rounded-full ring ring-secondary ring-offset-base-100 ring-offset-4 overflow-hidden">

                        @if ($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                class="w-full h-full object-cover" />
                        @else
                            <div
                                class="flex items-center justify-center w-full h-full
                           bg-linear-to-br from-secondary to-accent
                           text-secondary-content text-4xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif

                    </div>
                </div>

                <!-- File Input -->
                <input type="file"
                    name="profile_photo"
                    class="file-input file-input-bordered w-full" />
            </div>


            <!-- Name -->
            <div class="form-control">
                <label class="label font-semibold">Name</label>
                <input type="text"
                    name="name"
                    class="input input-bordered w-full"
                    placeholder="Enter your name"
                    value="{{ old('name', Auth::user()->name ?? '') }}">
            </div>

            <!-- About Me -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">About Me</span>
                </label>
                <textarea name="about_me"
                    class="textarea textarea-bordered w-full h-32"
                    placeholder="Write something about yourself">{{ old('about_me', $profile->about_me ?? '') }}</textarea>
            </div>

            <!-- Contact Number -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Contact Number</span>
                </label>
                <input type="text"
                    name="contact_number"
                    class="input input-bordered w-full"
                    placeholder="Enter your contact number"
                    value="{{ old('contact_number', $profile->contact_number ?? '') }}" />
            </div>

            <!-- Social Links Section -->
            <h3 class="text-xl font-semibold mt-8 text-primary">Social Links
            </h3>

            <!-- Facebook -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Facebook URL</span>
                </label>
                <input type="text"
                    name="facebook"
                    class="input input-bordered w-full"
                    placeholder="https://facebook.com/yourprofile"
                    value="{{ old('facebook', $profile->facebook ?? '') }}" />
            </div>

            <!-- Instagram -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Instagram URL</span>
                </label>
                <input type="text"
                    name="instagram"
                    class="input input-bordered w-full"
                    placeholder="https://instagram.com/yourprofile"
                    value="{{ old('instagram', $profile->instagram ?? '') }}" />
            </div>

            <!-- LinkedIn -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">LinkedIn URL</span>
                </label>
                <input type="text"
                    name="linkedin"
                    class="input input-bordered w-full"
                    placeholder="https://linkedin.com/in/yourprofile"
                    value="{{ old('linkedin', $profile->linkedin ?? '') }}" />
            </div>

            <!-- Twitter / X -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Twitter / X
                        URL</span>
                </label>
                <input type="text"
                    name="twitter"
                    class="input input-bordered w-full"
                    placeholder="https://x.com/yourprofile"
                    value="{{ old('twitter', $profile->twitter ?? '') }}" />
            </div>

            <!-- Buttons -->
            <div
                class="form-control mt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <a href="{{ route('client.profile.show') }}"
                    class="btn btn-outline btn-error w-full md:w-auto">
                    Cancel
                </a>
                <button type="submit"
                    class="btn btn-success w-full md:w-auto">
                    💾 Save Changes
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
