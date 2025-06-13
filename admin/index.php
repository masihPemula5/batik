<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; align-items: center; justify-content: center; height: 100vh; background-color: #f8f9fa; }
        .login-card { max-width: 400px; padding: 2rem; }
    </style>
</head>
<body>
    <div class="card login-card">
        <h3 class="card-title text-center mb-4">Admin Login</h3>
        <form action="proses_login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          <a href="../index.php" class="btn btn-secondary w-100 mt-3">kembali</a>
        </form>
    </div>
</body>
</html>