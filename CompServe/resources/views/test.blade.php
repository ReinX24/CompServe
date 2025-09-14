<!DOCTYPE html>
<html lang="en"
    data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- Main Container -->
    <div class="min-h-screen flex flex-col">
        Test
        <input type="checkbox"
            value="dark"
            class="toggle theme-controller" />
    </div>
</body>

</html>
