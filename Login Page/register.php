<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Register</h2>
            <form action="register_process.php" method="post">
                <div class="input-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-group">
                    <label for="nim">NIM:</label>
                    <input type="text" name="nim" id="nim" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Password must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 or more characters" required>
                </div>
                <div class="input-group">
                    <input type="submit" value="Register">
                </div>
            </form>
            <p>Already have an account? <a href="index.php">Login here</a></p>
        </div>
    </div>
    <?php
    // Di bagian atas file register.php
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<script>alert('$message');</script>"; // Tidak melakukan redirect setelah menampilkan popup notifikasi
    }
    ?>
</body>
</html>
