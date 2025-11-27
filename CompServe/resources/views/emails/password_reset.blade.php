<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Reset Notification</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme"
        content="light dark">
    <meta name="supported-color-schemes"
        content="light dark">

    <style>
        body {
            margin: 0;
            padding: 1.5rem;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #111827;
            box-sizing: border-box;
            /* ensures padding doesn’t cause overflow */
        }

        .email-card {
            max-width: 28rem;
            width: 100%;
            margin: 0 auto;
            /* centers the card */
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            box-sizing: border-box;
            /* include padding in width */
            min-width: 0;
            /* prevents overflow inside flex containers */
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .logo img {
            height: 16rem;
            width: 16rem;
            object-fit: contain;
            border-radius: 50%;
        }

        .notification-badge {
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: bold;
            margin-bottom: 1.25rem;
            box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3);
        }

        p {
            margin: 0 0 1rem 0;
            line-height: 1.6;
        }

        .password-box {
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: bold;
            font-size: 1.125rem;
            color: #111827;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 2rem 0;
        }

        .footer {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* Dark Mode */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #111827;
                color: #e5e7eb;
            }

            .email-card {
                background-color: #1f2937;
                border-color: #374151;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            .notification-badge {
                background-color: #2563eb;
                box-shadow: 0 2px 6px rgba(37, 99, 235, 0.4);
            }

            .password-box {
                background-color: #374151;
                border-color: #4b5563;
                color: #f3f4f6;
            }

            .divider {
                background-color: #374151;
            }

            .footer {
                color: #9ca3af;
            }
        }

        /* Mobile adjustments */
        @media (max-width: 480px) {
            .email-card {
                padding: 1.5rem;
            }

            .notification-badge {
                font-size: 0.75rem;
                padding: 0.375rem 0.75rem;
            }

            .password-box {
                font-size: 1rem;
                padding: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <div
        style="display:flex; justify-content:center; align-items:flex-start; min-height:100vh; padding:1.5rem;">
        <div class="email-card">
            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}"
                    alt="CompServe Logo">
            </div>

            <!-- Notification Badge -->
            <div class="notification-badge">🔐 Password Reset</div>

            <!-- Greeting -->
            <p>Hello <strong>{{ $user->name }}</strong> 👋</p>

            <p>Your password has been reset by an administrator.</p>

            <p><strong>Your new temporary password:</strong></p>

            <!-- Password Box -->
            <div class="password-box">{{ $newPassword }}</div>

            <p>Please log in and change your password immediately for security
                purposes.</p>

            <div class="divider"></div>

            <!-- Footer -->
            <div class="footer">
                <p>CompServe © {{ date('Y') }}</p>
                <p>Automated email — please do not reply.</p>
            </div>
        </div>
    </div>
</body>

</html>
