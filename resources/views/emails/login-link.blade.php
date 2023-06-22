<!DOCTYPE html>
<html>
<head>
    <title>Login Link</title>
</head>
<body>
    <h1>Welcome, {{ $user->full_name }}!</h1>
    <p>Click the following link to log in automatically :</p>
    <a href="{{ $loginLink }}">Log in</a>
        <p>http://154.118.230.22/login</p>

    
</body>
</html>

