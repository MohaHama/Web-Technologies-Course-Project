<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signUp</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="auth-container">
        <form method="POST" action="{{ route('registration.store') }}" class="auth-card">
            @csrf
            <h2>Register</h2>
            <!-- user infor for sign up -->
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>

            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </form>
    </div>
</body>

</html>