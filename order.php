
<?php
session_start();
include('configration.php');
$conn = mysqli_connect(servername, username, password, database);
if (!$conn) {
    die("connection failed " . mysqli_connect_error());
}
$flag = "";
if (!($_SESSION["email"]))
    header("location: LoginForm.php?result=" . "Please Log in first");
else {
    $user_email = $_SESSION["email"];
    $sql = "SELECT * FROM `users` WHERE `email` = '$user_email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $user_id = $row[0];
    $user_name = $row[1];
    $is_admin = $row[4];
}
$total = $_POST['total'];
$place = $_POST['place'];
$itemWithQuantity = $_POST['itemWithQuantity'];
$id = $user_id;
$sql = "INSERT INTO `orders` (`user_id`,`the_order` , `place_of_delivery`, `total`) VALUES ('$id','$itemWithQuantity' , '$place', '$total')";


if (mysqli_query($conn, $sql)) {
    $flag = "Thank you for your order, we will deliver it to you soon";
} else {
    $flag = "There is an error in your order, please try again or contact admin";
}
header("location: index.php?result=" . $flag);
?>