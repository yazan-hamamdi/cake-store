
<?php
session_start();
if (!($_SESSION["email"]))
    header("location: LoginForm.php?result=" . "Please Log in first");
else {
    include '../configration.php';
    $conn = mysqli_connect(servername, username, password, database);
    if (!$conn) {
        die("connection failed " . mysqli_connect_error());
    }
    $user_email = $_SESSION["email"];
    $sql = "SELECT * FROM `users` WHERE `email` = '$user_email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $user_id = $row[0];
    $user_name = $row[1];
    $is_admin = $row[4];
    if ($is_admin == 0) {
        mysqli_close($conn);
        header("location: index.php?result=" . "you not authorized");
    }
}
$flag = "";

if (isset($_POST['add_user'])) {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $check = "SELECT * FROM users WHERE email = '$email'";
    $resultCheck = mysqli_query($conn, $check);
    if (mysqli_num_rows($resultCheck) > 0) {
        $flag = "email already exists";
    }
    $password = $_POST['password'];
    $is_admin = $_POST['is_admin'];

    $sql = "INSERT INTO users (user_name, email, password, is_admin) VALUES ('$user_name', '$email', '$password', '$is_admin')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $flag = "user added successfully";
    } else {
        $flag = "add user failed";
    }
}
mysqli_close($conn);
header("Location: ../ControlPanel.php?result=$flag");

?>