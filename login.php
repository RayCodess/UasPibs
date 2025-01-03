<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
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
            <form id="loginForm">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" placeholder="Enter Username...">
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" placeholder="Password">
                </div>
                <div class="input-group">
                    <button type="button" onclick="handleLogin()">Login</button>
                </div>
                <p id="errorMessage" class="error-message"></p>
            </form>
        </div>
    </div>

    <script>
        function handleLogin() {
            var username = document.getElementById('username').value.trim();
            var password = document.getElementById('password').value.trim();
            var errorMessage = document.getElementById('errorMessage');
            
            // Reset error message
            errorMessage.textContent = "";

            // Simulate login
            if (username === 'admin' && password === 'password123') {
                window.location.href = "dashboardAdmin.php";
            } else if (username === 'user' && password === 'user123') {
                window.location.href = "dashboard.php";
            } else {
                errorMessage.textContent = "Invalid credentials, please try again.";
            }
        }
    </script>
</body>
</html>
