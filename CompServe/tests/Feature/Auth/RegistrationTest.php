<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// ==================== EXISTING TESTS ====================

test('freelancer registration screen can be rendered', function () {
    $response = $this->get('/register/freelancer');
    $response->assertStatus(200);
});

test('client registration screen can be rendered', function () {
    $response = $this->get('/register/client');
    $response->assertStatus(200);
});

test('new freelancer users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/freelancer/dashboard');
});

test('new client users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'client'
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/client/dashboard');
});

// ==================== VALIDATION TESTS ====================

test('registration requires name', function () {
    $response = $this->post('/register', [
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $response->assertSessionHasErrors(['name']);
});

test('registration requires email', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $response->assertSessionHasErrors(['email']);
});

test('registration requires valid email format', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'not-an-email',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $response->assertSessionHasErrors(['email']);
});

test('email must be unique', function () {
    User::factory()->create(['email' => 'test@example.com']);

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $response->assertSessionHasErrors(['email']);
});

test('registration requires password', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $response->assertSessionHasErrors(['password']);
});

test('registration requires password confirmation', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'role' => 'freelancer'
    ]);

    $response->assertSessionHasErrors(['password']);
});

test('password must be confirmed', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'different-password',
        'role' => 'freelancer'
    ]);

    $response->assertSessionHasErrors(['password']);
});

test('password must meet minimum length requirements', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'short',
        'password_confirmation' => 'short',
        'role' => 'freelancer'
    ]);

    $response->assertSessionHasErrors(['password']);
});

test('registration requires role', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasErrors(['role']);
});

test('role must be valid', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'invalid-role'
    ]);

    $response->assertSessionHasErrors(['role']);
});

// ==================== DATABASE TESTS ====================

test('freelancer is saved to database with correct role', function () {
    $this->post('/register', [
        'name' => 'Test Freelancer',
        'email' => 'freelancer@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $this->assertDatabaseHas('users', [
        'name' => 'Test Freelancer',
        'email' => 'freelancer@example.com',
        'role' => 'freelancer'
    ]);
});

test('client is saved to database with correct role', function () {
    $this->post('/register', [
        'name' => 'Test Client',
        'email' => 'client@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'client'
    ]);

    $this->assertDatabaseHas('users', [
        'name' => 'Test Client',
        'email' => 'client@example.com',
        'role' => 'client'
    ]);
});

test('password is hashed in database', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $user = User::where('email', 'test@example.com')->first();

    expect($user->password)->not->toBe('password')
        ->and(Hash::check('password', $user->password))->toBeTrue();
});

// ==================== AUTHENTICATION TESTS ====================

test('freelancer is automatically logged in after registration', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $this->assertAuthenticated();
    expect(auth()->user()->email)->toBe('test@example.com')
        ->and(auth()->user()->role)->toBe('freelancer');
});

test('client is automatically logged in after registration', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'client'
    ]);

    $this->assertAuthenticated();
    expect(auth()->user()->email)->toBe('test@example.com')
        ->and(auth()->user()->role)->toBe('client');
});

test('authenticated users cannot access registration page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/register/freelancer');

    $response->assertRedirect('/dashboard'); // or wherever you redirect
});

// ==================== ROLE-BASED REDIRECT TESTS ====================

test('freelancer redirected to freelancer dashboard after registration', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $response->assertRedirect('/freelancer/dashboard');
});

test('client redirected to client dashboard after registration', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'client'
    ]);

    $response->assertRedirect('/client/dashboard');
});

// ==================== VIEW TESTS ====================

test('freelancer registration view contains correct form elements', function () {
    $response = $this->get('/register/freelancer');

    $response->assertSee('name="name"', false)
        ->assertSee('name="email"', false)
        ->assertSee('name="password"', false)
        ->assertSee('name="password_confirmation"', false)
        ->assertSee('value="freelancer"', false);
});

test('client registration view contains correct form elements', function () {
    $response = $this->get('/register/client');

    $response->assertSee('name="name"', false)
        ->assertSee('name="email"', false)
        ->assertSee('name="password"', false)
        ->assertSee('name="password_confirmation"', false)
        ->assertSee('value="client"', false);
});

// ==================== SECURITY TESTS ====================

// test('registration sanitizes input data', function () {
//     $response = $this->post('/register', [
//         'name' => '<script>alert("xss")</script>Test User',
//         'email' => 'test@example.com',
//         'password' => 'password',
//         'password_confirmation' => 'password',
//         'role' => 'freelancer'
//     ]);

//     $user = User::where('email', 'test@example.com')->first();

//     // Name should be sanitized
//     expect($user->name)->not->toContain('<script>');
// });

test('registration prevents sql injection in email', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => "test'; DROP TABLE users; --@example.com",
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    // Should fail validation, not cause SQL injection
    $response->assertSessionHasErrors(['email']);
});

// test('email is stored in lowercase', function () {
//     $this->post('/register', [
//         'name' => 'Test User',
//         'email' => 'TEST@EXAMPLE.COM',
//         'password' => 'password',
//         'password_confirmation' => 'password',
//         'role' => 'freelancer'
//     ]);

//     $this->assertDatabaseHas('users', [
//         'email' => 'test@example.com' // Should be lowercase
//     ]);
// });

// ==================== EDGE CASE TESTS ====================

test('registration handles long names gracefully', function () {
    $longName = str_repeat('a', 255);

    $response = $this->post('/register', [
        'name' => $longName,
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $this->assertAuthenticated();
    expect(auth()->user()->name)->toBe($longName);
});

test('registration trims whitespace from name', function () {
    $this->post('/register', [
        'name' => '  Test User  ',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $user = User::where('email', 'test@example.com')->first();

    expect($user->name)->toBe('Test User');
});

test('registration trims whitespace from email', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => '  test@example.com  ',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com'
    ]);
});

test('registration handles special characters in name', function () {
    $response = $this->post('/register', [
        'name' => "O'Brien-Smith",
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $this->assertAuthenticated();
    expect(auth()->user()->name)->toBe("O'Brien-Smith");
});

test('registration handles unicode characters in name', function () {
    $response = $this->post('/register', [
        'name' => 'José García',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $this->assertAuthenticated();
    expect(auth()->user()->name)->toBe('José García');
});

test('password can contain special characters', function () {
    $complexPassword = 'P@ssw0rd!#$%^&*()';

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => $complexPassword,
        'password_confirmation' => $complexPassword,
        'role' => 'freelancer'
    ]);

    $this->assertAuthenticated();

    $user = User::where('email', 'test@example.com')->first();
    expect(Hash::check($complexPassword, $user->password))->toBeTrue();
});

// ==================== RATE LIMITING TESTS ====================

// test('registration has rate limiting', function () {
//     // Attempt multiple registrations quickly
//     for ($i = 0; $i < 6; $i++) {
//         $this->post('/register', [
//             'name' => "Test User $i",
//             'email' => "test$i@example.com",
//             'password' => 'password',
//             'password_confirmation' => 'password',
//             'role' => 'freelancer'
//         ]);
//     }

//     // Next attempt should be rate limited (if implemented)
//     $response = $this->post('/register', [
//         'name' => 'Test User',
//         'email' => 'test999@example.com',
//         'password' => 'password',
//         'password_confirmation' => 'password',
//         'role' => 'freelancer'
//     ]);

//     // Uncomment if rate limiting is implemented
//     // $response->assertStatus(429);
// })->skip('Rate limiting not yet implemented');

// ==================== EMAIL VERIFICATION TESTS ====================

test('freelancer email is not verified by default', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    $user = User::where('email', 'test@example.com')->first();

    expect($user->email_verified_at)->toBeNull();
});

test('client email is not verified by default', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'client'
    ]);

    $user = User::where('email', 'test@example.com')->first();

    expect($user->email_verified_at)->toBeNull();
});

// ==================== USER COUNT TESTS ====================

test('registration increases user count', function () {
    $initialCount = User::count();

    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    expect(User::count())->toBe($initialCount + 1);
});

test('failed registration does not increase user count', function () {
    $initialCount = User::count();

    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'invalid-email',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'freelancer'
    ]);

    expect(User::count())->toBe($initialCount);
});

// ==================== MULTIPLE ROLE TESTS ====================

test('cannot register with multiple roles', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => ['freelancer', 'client'] // Array instead of string
    ]);

    $response->assertSessionHasErrors(['role']);
});

// ==================== GUEST MIDDLEWARE TESTS ====================

test('logged in freelancer cannot register as client', function () {
    $user = User::factory()->create(['role' => 'freelancer']);

    $response = $this->actingAs($user)->post('/register', [
        'name' => 'Another User',
        'email' => 'another@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'client'
    ]);

    $response->assertRedirect(); // Should redirect away from registration
});
