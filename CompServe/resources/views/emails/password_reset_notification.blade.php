<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Password Reset Notification</title>
</head>

<body
    style="font-family: Arial, sans-serif; background-color: #f9fafb; padding: 20px;">
    <div
        style="max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px;">
        <h2 style="color: #3b82f6;">Hello, {{ $user->name }}!</h2>

        <p>Your password has been successfully reset by an administrator.</p>

        <p><strong>Here is your new password:</strong></p>

        <div
            style="background-color: #f3f4f6; padding: 10px; border-radius: 5px; font-weight: bold;">
            {{ $newPassword }}
        </div>

        <p>Please log in and change your password as soon as possible for
            security purposes.</p>

        <p style="margin-top: 30px;">Thank you,<br>CompServe Admin Team</p>
    </div>
</body>

</html>
