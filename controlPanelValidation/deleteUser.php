
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
    if ($is_admin == 0)
        header("location: index.php?result=" . "you not authorized");
}

$flag = "";

if (isset($_POST['delete_user'])) {
    $id = $_POST['user_id'];
    $check = "SELECT * FROM users WHERE id = '$id'";
    $resultCheck = mysqli_query($conn, $check);
    if (mysqli_num_rows($resultCheck) == 0) {
        $flag = "user not found";
    } else {
        $sql = "DELETE FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $flag = "user deleted successfully";
        } else {
            $flag = "delete user failed";
        }
    }
}
header("Location: ../ControlPanel.php?result=$flag");

?>