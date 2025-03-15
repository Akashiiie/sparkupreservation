<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="adminloginstyles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <img src="logo.png" alt="SparkUp Logo" class="logo">
            <h2>SPARK<span class="bold">UP</span></h2>
            
            <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']); // Clear error message after displaying
            }
            ?>

            <form action="login.php" method="POST">
                <input type="text" id="admin_id" name="admin_id" placeholder="Admin ID" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                
                <div class="options">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                    <a href="forgotpassword.php" class="forgot-password">Forgot password?</a>
                </div>
                
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>
