<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - {{ $title ?? 'Login / Register' }}</title>
    @vite('resources/css/app.css')
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
    class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased"
    x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true',
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
        }
    }"
    :class="{ 'dark': darkMode }">

    <div class="min-h-screen flex flex-col">
        <!-- Main Content -->
        <main class="flex-1 flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
