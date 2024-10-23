<?php
/*session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}*/
include('function.php');
include('header.php');

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
            alert('user baru berhasil ditambahkan!');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
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
        <h1>Form Pendaftaran</h1>
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
                <li>
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" name="password2" id="password2">
                </li>
                <li>
                    <button type="submit" name="register" class="submit">Registrasi</button>
                </li>
                <a href="login.php">login</a>
                <li>
            </ul>
        </form>
    </div>
</body>

</html>