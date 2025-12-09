<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    @if($errors->any())
    @foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
    @endforeach
    @endif
    <div class="auth-container">
        <form method="POST" action="{{ route('login.store') }}" class="auth-card">
            @csrf
            <h2>Login</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p>Don’t have an account? <a href="{{ route('registration.create') }}">Register</a></p>



        </form>
    </div>
</body>

</html>