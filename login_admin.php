<?php
/*session_start();*/


require 'function.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($result) == 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            //set session
            $_SESSION["login"] = true;
            header("location: index_admin.php");
            exit;
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <style>

    </style>
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,700&display=swap" rel="stylesheet" />

    <!--feather icons-->
    <script src="https://unpkg.com/feather-icons"></script>
    <!--my style-->
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <div class="registrasi">
        <h1>Halaman Login Admin</h1>
        <?php if (isset($error)): ?>
            <p style="color: red; font-style: italic;">username/password salah</p>
        <?php endif; ?>

        <form action="" method="post">
            <ul>
                <li>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </li>
                <p style="color: black">belum punya akun?</p>
                <a href="registrasi.php">daftar</a>
                <li>
                    <button type="submit" name="login" class="submit">Login</button>
                </li>
            </ul>
        </form>
    </div>
</body>