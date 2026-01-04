<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\PasswordReset;

// Basic password reset test
test('password can be reset with valid token', function () {
    Event::fake();

    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    $response = $this
        ->from(route('password.reset', ['token' => $token]))
        ->post(route('password.store'), [
            'token' => $token,
            'email' => 'test@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('login'))
        ->assertSessionHas('status');

    expect(Hash::check('new-password', $user->refresh()->password))->toBeTrue();

    Event::assertDispatched(PasswordReset::class, function ($event) use ($user) {
        return $event->user->id === $user->id;
    });
});

// Token is required
test('password reset requires token', function () {
    $response = $this->post(route('password.store'), [
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors(['token']);
});

// Email is required
test('password reset requires email', function () {
    $response = $this->post(route('password.store'), [
        'token' => 'fake-token',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors(['email']);
});

// Email must be valid format
test('password reset requires valid email format', function () {
    $response = $this->post(route('password.store'), [
        'token' => 'fake-token',
        'email' => 'not-an-email',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors(['email']);
});

// Password is required
test('password reset requires password', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    $response = $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors(['password']);
});

// Password confirmation is required
test('password reset requires password confirmation', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    $response = $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'new-password',
    ]);

    $response->assertSessionHasErrors(['password']);
});

// Passwords must match
test('password reset requires matching password confirmation', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    $response = $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'different-password',
    ]);

    $response->assertSessionHasErrors(['password']);
});

// Password must meet minimum requirements
test('password must meet minimum requirements', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    $response = $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'short',
        'password_confirmation' => 'short',
    ]);

    $response->assertSessionHasErrors(['password']);
});

// Invalid token fails
test('password reset fails with invalid token', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $oldPassword = $user->password;

    $response = $this->post(route('password.store'), [
        'token' => 'invalid-token',
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors(['email']);

    expect($user->refresh()->password)->toBe($oldPassword);
});

// Nonexistent user fails
test('password reset fails for nonexistent user', function () {
    $response = $this->post(route('password.store'), [
        'token' => 'some-token',
        'email' => 'nonexistent@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors(['email']);
});

// Email/token mismatch fails
test('password reset fails when email does not match token', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $otherUser = User::factory()->create(['email' => 'other@example.com']);
    $token = Password::createToken($user);

    $response = $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'other@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors(['email']);
});

// Remember token is updated
test('password reset updates remember token', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $oldRememberToken = $user->remember_token;
    $token = Password::createToken($user);

    $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    expect($user->refresh()->remember_token)->not->toBe($oldRememberToken);
});

// User cannot login with old password
test('user cannot login with old password after reset', function () {
    $oldPassword = 'old-password';
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make($oldPassword)
    ]);
    $token = Password::createToken($user);

    $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => $oldPassword,
    ]);

    expect(auth()->check())->toBeFalse();
});

// Token cannot be reused
test('password reset token cannot be reused', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    // First reset - should succeed
    $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    // Try to reuse the same token - should fail
    $response = $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'another-password',
        'password_confirmation' => 'another-password',
    ]);

    $response->assertSessionHasErrors(['email']);

    expect(Hash::check('new-password', $user->refresh()->password))->toBeTrue();
    expect(Hash::check('another-password', $user->password))->toBeFalse();
});

// Successful reset redirects to login with status
test('successful password reset redirects to login with status', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    $response = $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('status');

    expect(session('status'))->toBe(__('passwords.reset'));
});

// Failed reset redirects back with email
test('failed password reset redirects back with email', function () {
    $response = $this->from(route('password.reset', ['token' => 'fake']))
        ->post(route('password.store'), [
            'token' => 'invalid-token',
            'email' => 'test@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response->assertRedirect(route('password.reset', ['token' => 'fake']));
    $response->assertSessionHasErrors(['email']);

    expect(old('email'))->toBe('test@example.com');
});

// PasswordReset event is dispatched
test('password reset event is dispatched', function () {
    Event::fake([PasswordReset::class]);

    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    Event::assertDispatched(PasswordReset::class);
});

// Event receives correct user
test('password reset event receives correct user', function () {
    Event::fake();

    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    Event::assertDispatched(PasswordReset::class, function ($event) use ($user) {
        return $event->user->id === $user->id
            && $event->user->email === $user->email;
    });
});

// Expired token fails
test('password reset fails with expired token', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    // Simulate token expiration
    $this->travel(2)->hours();

    $response = $this->post(route('password.store'), [
        'token' => $token,
        'email' => 'test@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors(['email']);
});

// Reset password screen can be rendered
test('reset password screen can be rendered', function () {
    $user = User::factory()->create();
    $token = Password::createToken($user);

    $response = $this->get(route('password.reset', ['token' => $token]));

    $response->assertOk();
    $response->assertViewIs('auth.reset-password');
});

// View receives request with token
test('reset password view receives token in request', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $token = Password::createToken($user);

    $response = $this->get(route('password.reset', [
        'token' => $token,
        'email' => 'test@example.com'
    ]));

    $response->assertOk();
    $response->assertViewHas('request');
});