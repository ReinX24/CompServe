<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <script>
        window.setAppearance = function(theme) {
            const root = document.documentElement;
            const validThemes = ['light', 'dark'];
            if (!validThemes.includes(theme)) theme = 'light';

            root.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        };

        // Load saved theme on page load
        document.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', saved);
        });
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body {{-- class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased" --}}
    class="antialiased">

    {{-- Main Container --}}
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <x-layouts.app.guest-header />

        {{-- Hero Section --}}
        <main>
            <div
                class="flex flex-col items-center justify-center text-center h-svh px-6">

                <img src="{{ asset('images/logo.png') }}"
                    alt="Banner"
                    class="w-50 h-auto rounded-full shadow-md">

                <h2 class="text-3xl md:text-5xl font-extrabold mb-6">
                    Welcome to <span class="text-primary">CompServe</span>
                </h2>
                <p class="text-base md:text-xl max-w-2xl mb-8">
                    CompServe is your trusted online platform for freelancers
                    specializing in <span class="font-medium">hardware
                        maintenance</span>
                    and other services. Connect with skilled experts or offer
                    your
                    services to clients in need.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="#join-section"
                        class="px-6 py-3 btn btn-accent w-full sm:w-auto text-center">
                        Get Started
                    </a>
                    <a href="#about"
                        class="px-6 py-3 btn btn-primary w-full sm:w-auto text-center">
                        About
                    </a>
                </div>
            </div>

            {{-- About section --}}
            <section id="about"
                class="min-h-screen flex items-center bg-base-200 px-6 py-16">

                <div class="max-w-5xl mx-auto text-center space-y-8">

                    <h2
                        class="text-3xl md:text-5xl font-extrabold text-primary">
                        About <span class="text-secondary">CompServe</span>
                    </h2>

                    <p
                        class="text-lg md:text-xl leading-relaxed max-w-3xl mx-auto">
                        CompServe is a cutting-edge digital platform designed to
                        connect
                        skilled Filipino freelancers specializing in
                        <span class="font-semibold">computer repair, hardware
                            maintenance, IT services,
                            and technology support</span>
                        with clients who need reliable and professional
                        technical assistance.
                    </p>

                    <p
                        class="text-base md:text-lg max-w-3xl mx-auto">
                        We aim to bridge the gap between clients looking for
                        trustworthy tech
                        experts and freelancers seeking new opportunities to
                        grow their careers.
                        Whether you’re searching for a quick gig or long-term
                        contract work, CompServe
                        provides a secure and user-friendly platform to help you
                        reach your goals.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">

                        <div
                            class="p-6 rounded-xl bg-base-100 shadow-md hover:shadow-xl transition">
                            <div class="text-primary mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-10 w-10 mx-auto"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold">Fast & Reliable
                                Service</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                Connect instantly with qualified freelancers
                                ready to help you.
                            </p>
                        </div>

                        <div
                            class="p-6 rounded-xl bg-base-100 shadow-md hover:shadow-xl transition">
                            <div class="text-secondary mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-10 w-10 mx-auto"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 1.5l3.09 6.26 6.91 1-5 4.87 1.18 6.88L12 17.77l-6.18 3.24L7 13.63l-5-4.87 6.91-1L12 1.5z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold">Verified
                                Professionals</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                All freelancers undergo screening and can earn
                                certifications.
                            </p>
                        </div>

                        <div
                            class="p-6 rounded-xl bg-base-100 shadow-md hover:shadow-xl transition">
                            <div class="text-accent mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-10 w-10 mx-auto"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 0h8" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold">Career Growth</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                Freelancers can expand their portfolio and gain
                                more clients.
                            </p>
                        </div>

                    </div>

                    <div class="mt-12">
                        <a href="#join-section"
                            class="btn btn-primary px-8 py-4 text-lg">
                            Join CompServe Today
                        </a>
                    </div>

                </div>

            </section>

            {{-- Freelancer and Client Section --}}
            <section id="join-section"
                {{-- class="relative bg-white dark:bg-gray-800 min-h-screen flex items-center justify-center px-6 py-12"> --}}
                class="relative min-h-screen flex items-center justify-center px-6 py-12">
                <div class="max-w-7xl mx-auto w-full">
                    <div class="text-center mb-12">
                        <h2
                            class="text-2xl md:text-4xl font-bold text-secondary">
                            Join <span class="text-primary">CompServe</span>
                        </h2>
                        <p class="mt-4 text-base md:text-lg">
                            Whether you're a freelancer or a client, we have a
                            space for you.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        {{-- Freelancer Card --}}
                        <div {{-- class="flex flex-col items-center bg-gray-50 dark:bg-gray-900 rounded-2xl shadow-lg p-6 md:p-8 transition hover:shadow-xl"> --}}
                            class="flex flex-col items-center rounded-2xl shadow-lg p-6 md:p-8 transition hover:shadow-xl">
                            <div
                                class="w-14 h-14 md:w-16 md:h-16 flex items-center justify-center rounded-full bg-primary text-white mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 md:w-8 md:h-8">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <h3
                                class="text-lg md:text-xl font-semibold text-primary">
                                Freelancers
                            </h3>
                            <p
                                class="text-sm md:text-base text-gray-600 dark:text-gray-400 mt-2 text-center">
                                Showcase your expertise, apply to jobs, and
                                build your career.
                            </p>
                            <div
                                class="mt-6 flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                                <a href="{{ route('login.freelancer') }}"
                                    class="btn btn-primary w-full sm:w-auto">Login</a>
                                <a href="{{ route('register.freelancer') }}"
                                    class="btn btn-accent w-full sm:w-auto">Register</a>
                            </div>
                        </div>

                        {{-- Client Card --}}
                        <div {{-- class="flex flex-col items-center bg-gray-50 dark:bg-gray-900 rounded-2xl shadow-lg p-6 md:p-8 transition hover:shadow-xl"> --}}
                            class="flex flex-col items-center rounded-2xl shadow-lg p-6 md:p-8 transition hover:shadow-xl">
                            <div
                                class="w-14 h-14 md:w-16 md:h-16 flex items-center justify-center rounded-full bg-accent text-white mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 md:w-8 md:h-8">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                            </div>
                            <h3
                                class="text-lg md:text-xl font-semibold text-accent">
                                Clients
                            </h3>
                            <p
                                class="text-sm md:text-base text-gray-600 dark:text-gray-400 mt-2 text-center">
                                Post jobs, connect with skilled freelancers, and
                                get work done.
                            </p>
                            <div
                                class="mt-6 flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                                <a href="{{ route('login.client') }}"
                                    class="btn btn-primary w-full sm:w-auto">Login</a>
                                <a href="{{ route('register.client') }}"
                                    class="btn btn-accent w-full sm:w-auto">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
