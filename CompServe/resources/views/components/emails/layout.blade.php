<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Notification' }}</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Dark Mode Support -->
    <style>
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #111827 !important;
                color: #e5e7eb !important;
            }

            .email-card {
                background-color: #1f2937 !important;
                border-color: #374151 !important;
            }

            .email-text {
                color: #d1d5db !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-sans p-6">

    <!-- Outer Card -->
    <div
        class="email-card max-w-lg mx-auto bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg p-8">

        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo.png') }}"
                alt="Logo"
                class="h-16 mx-auto object-contain">
        </div>

        <!-- Main Content Slot -->
        <div
            class="email-text text-gray-700 dark:text-gray-200 text-base leading-relaxed space-y-4">
            {{ $slot }}
        </div>

        <!-- Divider -->
        <div class="h-px bg-gray-200 dark:bg-gray-700 my-8"></div>

        <!-- Footer -->
        <div
            class="text-center text-gray-500 dark:text-gray-400 text-sm space-y-1">
            <p>CompServe © {{ date('Y') }}</p>
            <p>Automated email — please do not reply.</p>
        </div>

    </div>

</body>

</html>
