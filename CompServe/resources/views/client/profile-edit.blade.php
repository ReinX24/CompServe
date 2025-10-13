<x-layouts.app>
    <div class="max-w-3xl mx-auto mt-10 card bg-base-100 shadow-xl p-8">
        <h2 class="text-3xl font-bold mb-6 text-primary text-center">Edit Client
            Profile</h2>

        <form action="{{ route('client.profile.update') }}"
            method="POST"
            class="space-y-6">
            @csrf

            <!-- Company Name -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Company Name</span>
                </label>
                <input type="text"
                    name="company_name"
                    class="input input-bordered w-full"
                    placeholder="Enter your company name"
                    value="{{ old('company_name', $profile->company_name ?? '') }}" />
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

            <!-- Website -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Website</span>
                </label>
                <input type="text"
                    name="website"
                    class="input input-bordered w-full"
                    placeholder="https://example.com"
                    value="{{ old('website', $profile->website ?? '') }}" />
            </div>

            <!-- Bio -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">About Your
                        Company</span>
                </label>
                <textarea name="bio"
                    class="textarea textarea-bordered w-full h-28"
                    placeholder="Write a short description about your company">{{ old('bio', $profile->bio ?? '') }}</textarea>
            </div>

            <!-- Location -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Location</span>
                </label>
                <input type="text"
                    name="location"
                    class="input input-bordered w-full"
                    placeholder="City, Country"
                    value="{{ old('location', $profile->location ?? '') }}" />
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
