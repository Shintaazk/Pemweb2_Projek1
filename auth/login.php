<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    width: 100px;
    height: 100px;
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


if (isset($_POST['submit'])) {
    require_once '../admin/dbkoneksi.php';

    $email = $_POST['email'];
    $password = $_POST ['password'];

    // Menggunakan prepared statement dan parameter binding untuk mencegah SQL Injection
    $user = $dbh->prepare("SELECT * FROM users WHERE email = ?");
    $user->execute([$email]);

    // Menggunakan password_verify() jika password telah di-hash
    if ($user->rowCount() > 0) {
        $user_data = $user->fetch();
        if (password_verify($password, $user_data['password'])) {
            session_start();
            $_SESSION['user'] = $user_data;
            header("Location: /project01/admin/dashboard");
            exit;
        }
    }

    // Jika email atau password tidak cocok
    // header("Location: login.php");
    exit;
}

// Periksa apakah session masih ada
if (isset($_SESSION['user'])) {
    echo "Session masih aktif!";
} else {
    echo "Session telah dihapus.";
}
?>


<body>
    <div class="container">
        <img src="..\user\images\Logo2.png" alt="">
        <h1>Login</h1>
        <form action="" method="POST">
                <input type="email" id="input" name="email" placeholder="Email" required><br>
                <input type="password" id="input" name="password" placeholder="Password" required><br>
                <button type="submit" id="submit" name="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Registrasi</a></p>
    </div>
</body>

</html>