
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

if (isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];
    $check = "SELECT * FROM orders WHERE o_id = '$order_id'";
    $resultCheck = mysqli_query($conn, $check);
    if (mysqli_num_rows($resultCheck) == 0) {
        $flag = "order not found";
    } else {
        $sql = "DELETE FROM orders WHERE o_id = '$order_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $flag = "order deleted successfully";
        } else {
            $flag = "delete order failed";
        }
    }
}

header("Location: ../ControlPanel.php?result=$flag");

?>