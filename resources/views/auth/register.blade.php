<!DOCTYPE html>
<html>
<head>
    <title>Register - Logbook Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f4f6f9;">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width:400px;">
        <h3 class="text-center mb-4">Register Akun</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required pattern="[a-zA-Z]+" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" title="Username hanya boleh mengandung huruf, tidak boleh angka atau karakter khusus.">
                <small class="text-muted">Username hanya boleh mengandung huruf (a-z, A-Z)</small>
            </div>

            
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required pattern="[a-zA-Z].*" title="Password harus dimulai dengan huruf, tidak boleh angka atau karakter khusus di karakter pertama.">
                <small class="text-muted">Password harus dimulai dengan huruf (a-z, A-Z)</small>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">
                Register
            </button>
        </form>

        <div class="text-center mt-3">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>

</body>
</html>