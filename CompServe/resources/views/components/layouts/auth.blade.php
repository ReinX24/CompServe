<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - {{ $title ?? 'Login / Register' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        let htmlTag = document.documentElement;

        window.setAppearance = function(appearance) {
            let setDark = () => {
                document.documentElement.classList.add('dark');
                htmlTag.setAttribute('data-theme',
                    'dark');
            }
            let setLight = () => {
                document.documentElement.classList.remove(
                    'dark');
                htmlTag.setAttribute('data-theme', 'light');
            }
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
</head>

<body
    class="antialiased bg-linear-to-br from-primary/10 via-base-100 to-secondary/10"
    x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true',
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
        }
    }"
    :class="{ 'dark': darkMode }">

    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <x-layouts.app.guest-header />

        <!-- Main Content -->
        <main
            class="flex-1 flex items-start justify-center p-6 pt-24 overflow-y-auto">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
