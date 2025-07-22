<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: sans-serif;
            background: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .input-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.25rem;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .error {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            border: none;
            background: #007BFF;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
