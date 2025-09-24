<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script>
        window.setAppearance = function(appearance) {
            let setDark = () => document.documentElement.classList.add('dark')
            let setLight = () => document.documentElement.classList.remove(
                'dark')
            let setButtons = (appearance) => {
                document.querySelectorAll(
                    'button[onclick^="setAppearance"]').forEach((
                    button) => {
                    button.setAttribute('aria-pressed', String(
                        appearance === button.value))
                })
            }
            if (appearance === 'system') {
                let media = window.matchMedia('(prefers-color-scheme: dark)')
                window.localStorage.removeItem('appearance')
                media.matches ? setDark() : setLight()
            } else if (appearance === 'dark') {
                window.localStorage.setItem('appearance', 'dark')
                setDark()
            } else if (appearance === 'light') {
                window.localStorage.setItem('appearance', 'light')
                setLight()
            }
            if (document.readyState === 'complete') {
                setButtons(appearance)
            } else {
                document.addEventListener("DOMContentLoaded", () => setButtons(
                    appearance))
            }
        }
        window.setAppearance(window.localStorage.getItem('appearance') || 'system')
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased"
    x-data="{
        sidebarOpen: localStorage.getItem('sidebarOpen') === null ? window.innerWidth >= 1024 : localStorage.getItem('sidebarOpen') === 'true',
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
        },
        temporarilyOpenSidebar() {
            if (!this.sidebarOpen) {
                this.sidebarOpen = true;
                localStorage.setItem('sidebarOpen', true);
            }
        },
        formSubmitted: false,
    }">

    <!-- Main Container -->
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <x-layouts.app.guest-header />

        {{-- Hero Section --}}
        <main>
            <div
                class="flex flex-col items-center justify-center text-center px-6 py-24 h-full border">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
                    Welcome to <span class="text-blue-600">CompServe</span>
                </h2>
                <p
                    class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-2xl mb-8">
                    CompServe is your trusted online platform for freelancers
                    specializing in
                    <span class="font-medium">hardware maintenance</span> and
                    other
                    services.
                    Connect with skilled experts or offer your services to
                    clients
                    in need.
                </p>

                <div class="flex space-x-3">
                    {{-- TODO: replace to scrolling down to next section --}}
                    <a href="/"
                        class="px-6 py-3 btn btn-accent">
                        Get Started
                    </a>
                    {{-- TODO: replace with About section --}}
                    <a href="/"
                        class="px-6 py-3 btn btn-primary">
                        About
                    </a>
                </div>
            </div>

            {{-- Freelancer and Client --}}
            <div class="border">
                <div>
                    <p>Freelancer</p>

                    <a href="{{ route('login.freelancer') }}">Login</a>
                    <a href="{{ route('register.freelancer') }}">Register</a>
                </div>

                <div>
                    <p>Client</p>

                    <a href="{{ route('login.client') }}">Login</a>
                    <a href="{{ route('register.client') }}">Register</a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
