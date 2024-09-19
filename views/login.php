<?php
// Check if a session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session if none is active
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background: linear-gradient(135deg, #1a202c, #2d3748);
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .login-form {
        width: 100%;
        max-width: 380px;
        padding: 40px 30px;
        background: #2d3748;
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        transition: box-shadow 0.3s;
    }

    .login-form:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    }

    .login-form h2 {
        margin-bottom: 25px;
        font-size: 26px;
        font-weight: 600;
        color: #ffffff;
        text-align: center;
    }

    .login-form .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .login-form .form-control {
        width: 100%;
        border-radius: 30px;
        padding-left: 50px;
        padding-right: 50px;
        height: 50px;
        background: #4a5568;
        border: none;
        color: #ffffff;
    }

    .login-form .form-control:focus {
        border-color: #4c51bf;
        box-shadow: 0 0 6px rgba(76, 81, 191, 0.6);
        background: #4a5568;
        color: #ffffff;
    }

    .login-form .form-control-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #63b3ed;
    }

    .login-form .form-control-show-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #63b3ed;
    }

    .login-form .btn {
        width: 100%;
        font-size: 18px;
        border-radius: 30px;
        padding: 12px 0;
        background: #4c51bf;
        color: #ffffff;
        border: none;
        cursor: pointer;
        transition: background 0.3s, transform 0.3s;
    }

    .login-form .btn:hover {
        background: #3c366b;
        transform: scale(1.02);
    }

    .login-form .text-center {
        margin-top: 25px;
    }

    .login-form .text-center a {
        color: #63b3ed;
        text-decoration: none;
        transition: color 0.3s;
    }

    .login-form .text-center a:hover {
        color: #4c51bf;
    }

    .error-message {
        color: #f56565;
        font-size: 14px;
        text-align: center;
        margin-bottom: 15px;
    }
</style>

</head>

<body>
    <div class="login-form">

    <?php 
        if (isset($_SESSION["register-msg"])) {
            if ($_SESSION["register-msg"] === true) {
                echo '<script>alert("User Registered Successfully!");</script>';
            } else {
                echo '<script>alert("User Registration Failed!");</script>';
            }
            unset($_SESSION["register-msg"]);
        }
    ?>


        <h2>Login</h2>

        <form action="http://localhost/Secure-CRUD/public/index.php?action=login" method="POST">

            <div class="form-group position-relative">
                <i class="fas fa-user form-control-icon"></i>
                <input type="text" class="form-control" name="email" id="username" placeholder="Username" 
                    required 
                    <?php if (isset($_SESSION['login_locked']) && $_SESSION['login_locked']) echo 'disabled';?>>
            </div>

            <div class="form-group position-relative">
                <i class="fas fa-lock form-control-icon"></i>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" 
                    required 
                    <?php if (isset($_SESSION['login_locked']) && $_SESSION['login_locked']) echo 'disabled'; unset($_SESSION['login_locked']);?>>
                <i class="fas fa-eye form-control-show-password" id="togglePassword"></i>
            </div>

            <!-- Error message display -->
            <div class="error-message" id="error-message">
                <?php if (isset($_SESSION['login_error'])) {
                    echo $_SESSION['login_error'];
                    // Clear the error message after displaying it
                    unset($_SESSION['login_error']);
                }
                ?>
            </div>


            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <div class="text-center" style="color: white;">
                Don't have an account?
                <a href="/Secure-CRUD/public?action=signup"> Sign Up</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
