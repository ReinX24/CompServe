<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Certification Status Update</title>
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
        }

        .email-card {
            max-width: 28rem;
            width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            box-sizing: border-box;
            min-width: 0;
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

        /* STATUS COLORS */
        .status-box {
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: bold;
            font-size: 1.125rem;
            margin-bottom: 1.5rem;
            text-align: center;
            text-transform: capitalize;
            border: 1px solid transparent;
        }

        .status-approved {
            background-color: #d1fae5;
            border-color: #10b981;
            color: #065f46;
        }

        .status-pending {
            background-color: #fef9c3;
            border-color: #f59e0b;
            color: #92400e;
        }

        .status-rejected {
            background-color: #fee2e2;
            border-color: #ef4444;
            color: #991b1b;
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

        /* Dark Mode Adjustments */
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

            .status-approved {
                background-color: #064e3b;
                border-color: #10b981;
                color: #a7f3d0;
            }

            .status-pending {
                background-color: #78350f;
                border-color: #f59e0b;
                color: #fde68a;
            }

            .status-rejected {
                background-color: #7f1d1d;
                border-color: #ef4444;
                color: #fecaca;
            }

            .divider {
                background-color: #374151;
            }

            .footer {
                color: #9ca3af;
            }
        }

        /* Mobile Adjustments */
        @media (max-width: 480px) {
            .email-card {
                padding: 1.5rem;
            }

            .notification-badge {
                font-size: 0.75rem;
                padding: 0.375rem 0.75rem;
            }

            .status-box {
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
            <div class="notification-badge">📄 Certification Status Update</div>

            <!-- Greeting -->
            <p>Hello <strong>{{ $certification->freelancer->name }}</strong> 👋
            </p>

            <p>Your certification request has been reviewed.</p>

            <!-- Certification Type -->
            @php
                $typeIcons = [
                    'NC I' => '🟢',
                    'NC II' => '🔵',
                    'NC III' => '🟡',
                    'NC IV' => '🟠',
                    'Tech Certification' => '💻',
                ];

                // Choose the icon based on the certification type, default to 📄 if not found
                $icon = $typeIcons[$certification->type] ?? '📄';
            @endphp

            <p>
                <strong>Certification Type:</strong> {{ $icon }}
                {{ $certification->type }}
            </p>

            <!-- Status Box -->
            <div
                class="status-box
    @if ($status === 'approved') status-approved
    @elseif($status === 'pending') status-pending
    @else status-rejected @endif">
                {{ ucfirst($status) }}
            </div>

            <!-- Status Messages -->
            @if ($status === 'approved')
                <p>🎉 <strong>Congratulations!</strong> Your certification has
                    been approved.</p>
                <p>You may now enjoy the benefits associated with your
                    certification.</p>
            @elseif ($status === 'pending')
                <p>⏳ Your certification is still under review.</p>
                <p>We will notify you once a decision has been made.</p>
            @else
                <p>❌ Unfortunately, your certification has been rejected.</p>

                @if (!empty($reason))
                    <p><strong>Reason for Rejection:</strong></p>
                    <p
                        style="background:#fee2e2; padding:10px; border-radius:8px; border:1px solid #ef4444; color:#991b1b;">
                        {{ $reason }}
                    </p>
                @endif

                <p>If you believe this is a mistake, you may resubmit or contact
                    support.</p>
            @endif

            <!-- Button -->
            <div style="text-align:center; margin: 2rem 0;">
                <a href="{{ url('/certifications/' . $certification->id) }}"
                    style="background:#3b82f6; padding:12px 20px; color:white; border-radius:8px; text-decoration:none;
        font-weight:bold; display:inline-block;">
                    🔍 View Certification
                </a>
            </div>

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
