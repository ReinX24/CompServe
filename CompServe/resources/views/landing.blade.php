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

<body class="antialiased overflow-x-hidden">

    {{-- Main Container --}}
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <x-layouts.app.guest-header />

        {{-- Hero Section with Animated Background --}}
        <main>
            <div class="relative flex flex-col items-center justify-center text-center min-h-screen px-6 bg-gradient-to-br from-primary/10 via-base-100 to-secondary/10 overflow-hidden">

                {{-- Animated Background Elements --}}
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-20 left-10 w-72 h-72 bg-primary/20 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute bottom-20 right-10 w-96 h-96 bg-secondary/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-accent/10 rounded-full blur-3xl animate-pulse delay-500"></div>
                </div>

                {{-- Hero Content --}}
                <div class="relative z-10 space-y-8 animate-fade-in">
                    <div class="relative">
                        <div class="absolute inset-0 bg-primary/30 rounded-full blur-2xl animate-pulse"></div>
                        <img src="{{ asset('images/logo.png') }}"
                            alt="CompServe Logo"
                            class="relative w-32 h-32 md:w-40 md:h-40 mx-auto rounded-full shadow-2xl ring-4 ring-primary/50 hover:scale-110 transition-transform duration-300">
                    </div>

                    <div class="space-y-4">
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold">
                            Welcome to <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-accent animate-gradient">CompServe</span>
                        </h1>
                        <div class="max-w-3xl mx-auto">
                            <p class="text-lg md:text-2xl font-medium text-base-content/80 leading-relaxed">
                                Your trusted platform connecting skilled
                                <span class="font-bold text-primary">Filipino freelancers</span>
                                specializing in
                                <span class="font-bold text-secondary">hardware maintenance</span>
                                and tech services with clients nationwide
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-4">
                        <a href="#join-section"
                            class="group relative px-8 py-4 btn btn-accent btn-lg text-lg font-semibold shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 w-full sm:w-auto">
                            <span class="relative z-10">Get Started</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#about"
                            class="px-8 py-4 btn btn-outline btn-primary btn-lg text-lg font-semibold hover:scale-105 transition-all duration-300 w-full sm:w-auto">
                            Learn More
                        </a>
                    </div>

                    {{-- Scroll Indicator --}}
                    <div class="pt-12 animate-bounce">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- About Section with Cards --}}
            <section id="about"
                class="relative min-h-screen flex items-center bg-gradient-to-br from-base-200 to-base-300 px-6 py-20">

                <div class="max-w-7xl mx-auto w-full space-y-16">

                    {{-- Section Header --}}
                    <div class="text-center space-y-4">
                        <div class="inline-block">
                            <h2 class="text-4xl md:text-6xl font-extrabold">
                                About
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">
                                    CompServe
                                </span>
                            </h2>
                            <div class="h-1 bg-gradient-to-r from-primary via-secondary to-accent rounded-full mt-2"></div>
                        </div>
                        <p class="text-xl md:text-2xl text-base-content/70 max-w-3xl mx-auto leading-relaxed">
                            Empowering tech professionals and connecting them with opportunities
                        </p>
                    </div>

                    {{-- Description Cards --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                            <div class="card-body space-y-4">
                                <div class="badge badge-primary badge-lg">Our Mission</div>
                                <p class="text-lg leading-relaxed">
                                    CompServe is a cutting-edge digital platform designed to connect
                                    skilled Filipino freelancers specializing in
                                    <span class="font-bold text-primary">computer repair, hardware maintenance, IT services,
                                    and technology support</span>
                                    with clients who need reliable and professional technical assistance.
                                </p>
                            </div>
                        </div>

                        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                            <div class="card-body space-y-4">
                                <div class="badge badge-secondary badge-lg">Our Vision</div>
                                <p class="text-lg leading-relaxed">
                                    We bridge the gap between clients seeking trustworthy tech
                                    experts and freelancers pursuing career growth.
                                    Whether you need a quick gig or long-term contract work, CompServe
                                    provides a secure and user-friendly platform to achieve your goals.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Feature Cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                        <div class="card bg-gradient-to-br from-primary/10 to-primary/5 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-primary/20">
                            <div class="card-body items-center text-center space-y-4">
                                <div class="p-4 rounded-full bg-primary/20">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-12 w-12 text-primary"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                    </svg>
                                </div>
                                <h3 class="card-title text-2xl">Fast & Reliable</h3>
                                <p class="text-base-content/70">
                                    Connect instantly with qualified freelancers ready to solve your tech problems today.
                                </p>
                            </div>
                        </div>

                        <div class="card bg-gradient-to-br from-secondary/10 to-secondary/5 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-secondary/20">
                            <div class="card-body items-center text-center space-y-4">
                                <div class="p-4 rounded-full bg-secondary/20">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-12 w-12 text-secondary"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                    </svg>
                                </div>
                                <h3 class="card-title text-2xl">Verified Pros</h3>
                                <p class="text-base-content/70">
                                    All freelancers undergo thorough screening and can show official certifications.
                                </p>
                            </div>
                        </div>

                        <div class="card bg-gradient-to-br from-accent/10 to-accent/5 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-accent/20">
                            <div class="card-body items-center text-center space-y-4">
                                <div class="p-4 rounded-full bg-accent/20">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-12 w-12 text-accent"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                    </svg>
                                </div>
                                <h3 class="card-title text-2xl">Career Growth</h3>
                                <p class="text-base-content/70">
                                    Freelancers expand their portfolio, gain experience, and build lasting client relationships.
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="text-center pt-8">
                        <a href="#join-section"
                            class="btn btn-primary btn-lg px-10 text-lg shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                            Join CompServe Today
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                </div>

            </section>

            {{-- Join Section with Enhanced Cards --}}
            <section id="join-section"
                class="relative min-h-screen flex items-center justify-center px-6 py-20 bg-gradient-to-br from-base-100 via-primary/5 to-secondary/5">

                {{-- Background Decoration --}}
                <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-30">
                    <div class="absolute top-0 left-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent/20 rounded-full blur-3xl"></div>
                </div>

                <div class="max-w-7xl mx-auto w-full relative z-10">
                    {{-- Section Header --}}
                    <div class="text-center mb-16 space-y-4">
                        <div class="inline-block">
                            <h2 class="text-4xl md:text-6xl font-extrabold">
                                Join
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary to-primary">
                                    CompServe
                                </span>
                            </h2>
                            <div class="h-1 bg-gradient-to-r from-secondary to-primary rounded-full mt-2"></div>
                        </div>
                        <p class="text-xl md:text-2xl text-base-content/70">
                            Choose your path and start your journey today
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
                        {{-- Freelancer Card --}}
                        <div class="card bg-gradient-to-br from-primary/10 to-primary/5 shadow-2xl hover:shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] transition-all duration-300 hover:-translate-y-3 border-2 border-primary/30">
                            <div class="card-body items-center text-center space-y-6 p-8">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-primary/30 rounded-full blur-xl"></div>
                                    <div class="relative w-20 h-20 flex items-center justify-center rounded-full bg-gradient-to-br from-primary to-primary/70 text-white shadow-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-10 h-10">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <h3 class="text-3xl font-bold text-primary">
                                        For Freelancers
                                    </h3>
                                    <p class="text-lg text-base-content/70">
                                        Showcase your expertise, apply to exciting jobs, and build a thriving career in tech services.
                                    </p>
                                </div>

                                <div class="divider"></div>

                                <ul class="space-y-2 text-left w-full">
                                    <li class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Create your professional profile</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Browse and apply to gigs & contracts</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Showcase certifications and build reputation</span>
                                    </li>
                                </ul>

                                <div class="flex flex-col sm:flex-row gap-3 w-full pt-4">
                                    <a href="{{ route('login.freelancer') }}"
                                        class="btn btn-primary flex-1 hover:scale-105 transition-transform">
                                        Login
                                    </a>
                                    <a href="{{ route('register.freelancer') }}"
                                        class="btn btn-accent flex-1 hover:scale-105 transition-transform">
                                        Register
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Client Card --}}
                        <div class="card bg-gradient-to-br from-accent/10 to-accent/5 shadow-2xl hover:shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] transition-all duration-300 hover:-translate-y-3 border-2 border-accent/30">
                            <div class="card-body items-center text-center space-y-6 p-8">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-accent/30 rounded-full blur-xl"></div>
                                    <div class="relative w-20 h-20 flex items-center justify-center rounded-full bg-gradient-to-br from-accent to-accent/70 text-white shadow-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-10 h-10">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <h3 class="text-3xl font-bold text-accent">
                                        For Clients
                                    </h3>
                                    <p class="text-lg text-base-content/70">
                                        Post jobs, discover skilled professionals, and get your tech problems solved quickly.
                                    </p>
                                </div>

                                <div class="divider"></div>

                                <ul class="space-y-2 text-left w-full">
                                    <li class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Post gigs and contracts easily</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Review verified freelancer profiles</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Get quality work done on time</span>
                                    </li>
                                </ul>

                                <div class="flex flex-col sm:flex-row gap-3 w-full pt-4">
                                    <a href="{{ route('login.client') }}"
                                        class="btn btn-primary flex-1 hover:scale-105 transition-transform">
                                        Login
                                    </a>
                                    <a href="{{ route('register.client') }}"
                                        class="btn btn-accent flex-1 hover:scale-105 transition-transform">
                                        Register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <style>
        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 3s ease infinite;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
    </style>
</body>

</html>