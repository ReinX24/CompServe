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

            <!-- Contact Number -->
            <x-forms.input label="Contact Number"
                name="contact_number"
                type="text"
                placeholder="Enter your contact number"
                value="{{ old('contact_number', Auth::user()->contact_number) }}" />

            <!-- About Me -->
            <x-forms.input label="About Me"
                name="about_me"
                type="text"
                placeholder="Write something about yourself"
                value="{{ old('about_me', Auth::user()->about_me) }}"
                class="h-24" />

            <!-- Submit Button -->
            <button type="submit"
                class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                Save Changes
            </button>
        </form>
    </div>

</x-layouts.app>
