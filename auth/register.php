<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url("slider2.jpg");
    background-repeat: no-repeat;
}

.container {
    width: 300px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

img {
    display: block;
    margin: 0 auto;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 20px;
}

h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

form {
    text-align: center;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

p {
    text-align: center;
    margin-top: 15px;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>

</head>

<?php
if (isset($_POST['register'])) {
    require_once '../admin/dbkoneksi.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lakukan validasi data registrasi di sini jika diperlukan
    // Misalnya, validasi email harus unik
    $check_email = $dbh->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->execute([$email]);
    $email_count = $check_email->rowCount();

    if ($email_count > 0) {
        echo "Email sudah digunakan, silakan gunakan email lain.";
    } else {
        // Hash password sebelum disimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Tambahkan user ke database dengan password yang di-hash
        $insert_user = $dbh->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $insert_user->execute([$username, $email, $hashed_password]);

        if ($insert_user) {
            echo "Registrasi berhasil!";
        } else {
            echo "Registrasi gagal. Silakan coba lagi.";
        }
    }
}
?>


<body>
    <div class="container">
        <img src="..\user\images\Logo2.png" alt="">
        <h1>Registrasi</h1>
        <form action="" method="POST">
            <input type="text" id="register-input" name="username" placeholder="Username" required><br>
            <input type="email" id="register-input" name="email" placeholder="Email" required><br>
            <input type="password" id="register-input" name="password" placeholder="Password" required><br>
            <button type="submit" id="register-submit" name="register">Register</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>