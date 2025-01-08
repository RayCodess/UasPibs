<?php
include('koneksiLogin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="image-section">
            <img 
                src="https://storage.googleapis.com/a1aa/image/629Cl1FtVP4pPZiFVliZJHPeQU9FRmX5cJL5ubah6MsP0KfTA.jpg" 
                alt="Colorful houses along a river">
            <div class="image-overlay">
                Welcome Back!
            </div>
        </div>
        <div class="form-section">
            <h2>Login</h2>
            <form method="POST" action="">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Enter Username..." required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
