<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "ayamgeprek";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Gagal Terkoneksi");
} else {
    echo "";
}
function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username ada/belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username= '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!')
                </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('Konfirmasi Password Salah!');
        </script>";
        return false;
    }
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //nambah user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}
